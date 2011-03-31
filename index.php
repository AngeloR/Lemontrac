<?php session_start();

include('lib/limonade.php');
include('lib/app.php');
include('lib/smart_image_resize.php');
$config = include('appconfig.php');


function gravatar($hashed_email,$size = '80') {
    return 'http://www.gravatar.com/avatar/'.$hashed_email.'.jpg?s='.$size;
}

function avatar($email,$size) {
    $email = md5($email);
    if(file_exists('uploads/avatars/'.$email)) {
        $image = getimagesize('uploads/avatars/'.$email);
        header('Content-type: '.$image['mime']);
        switch($image['mime']) {
            case 'image/png':
                imagepng(imagecreatefrompng('uploads/avatars/'.$email));
                break;
        }
    }
    else {
        header('Content-type: image/jpeg');
        return file_get_contents(gravatar($email));
    }
}

function excerpt($str,$size = 100) {
    return (strlen($str) < $size)?$str:substr($str,0,$size).'...';
}

function pretty_date($timestamp) {
    $now = date('n/j/y g:ia',time());
    $date = date('n/j/y g:ia',$timestamp);

    $date_split = explode(' ',$date);
    $now_split = explode(' ',$now);

    // today
    if($date_split[0] == $now_split[0]) {
        return 'today at '.$date_split[1]; 
    }

    // yesterday
    $date_split_2 = explode('/',$date_split[0]);
    $now_split_2 = explode('/',$now_split[0]);

    if($date_split_2[1] == ($now_split_2[1] - 1)) {
        return 'yesterday at '.$date_split[1];
    }

    return $date.' '.$time;
}

function user() {
    global $config;
    if(array_key_exists($config['session'],$_SESSION)) {
        $args = func_get_args();

        if($args[1] == null) {
            if($args[0] == null) {
                return unserialize($_SESSION[$config['session']]);
            }
            else {
                $user = unserialize($_SESSION[$config['session']]);
                return $user[$args[0]];
            }
        }
        else {
            $user = unserialize($_SESSION[$config['session']]);
            $user[$args[0]] = $args[1];
            $_SESSION[$config['session']] = serialize($user);
        }

    }
    return false;
}

function configure() {
    global $config;
    $c = mysql_connect($config['db']['host'],$config['db']['user'],$config['db']['pass']);
    $d = mysql_select_db('bugtrack',$c);
}

function before() {
    layout('layout.php');
    if(!user() && request_uri() != '/login' && request_uri() != '/register') {
        redirect('/login');
    }
}

function login() {
    return render('login.html.php');
}

function login_handler() {
    global $config;
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    $password = ext_hash($password);

    $sql = 'select * from users where username="'.$username.'" and password="'.$password.'"';

    $res = db($sql);
    if(count($res[0]) > 0) {
        $_SESSION[$config['session']] = serialize($res[0]);
        redirect('/');
    }
    else {
        ext_error('Sorry, there was an error with your login credentials');
        return login();
    }
}

function register_handler() {
    global $config, $events;
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $conf_pass = mysql_real_escape_string($_POST['conf_password']);
    $email = mysql_real_escape_string($_POST['email']);
    $time = time();

    if($password != $conf_pass) {
        ext_error('Sorry, the passwords that you entered do not match.');
    }
    else {
        $password = ext_hash($password);
        $sql = 'insert into users (username,password,email,created_time,updated_time) values("'.$username.'","'.$password.'","'.$email.'",'.$time.','.$time.')';
        if(db($sql)) {
           

            $sql = 'select * from users where username = "'.$username.'" and password= "'.$password.'"';
            $res = db($sql);

            $_SESSION[$config['session']] = serialize($res[0]);
            ext_log('REGISTERED_USER','',$time);
            redirect('/');
        }
        else {
            ext_error('Sorry, there was an error with our database.');
        }
    }

    return login();
}

function ext_hash($val) {
    return sha1('139n9'.$val.'139vnv');
}

function logout_handler() {
    global $config;

    $_SESSION[$config['session']] = null;
    redirect('/');
}

function bug_list($pjid) {
    global $priority_map;
    $res = db('select b.*,p.color,u.user_id,u.username,u.email from bugs as b, projects as p, users as u where b.project_id = p.project_id and b.created_by = u.user_id and b.project_id = '.$pjid.' and b.fixed = 0 order by b.updated_time desc');


    set('priority_map',$priority_map);
    set('bugs',$res);
    return render('buglist.html.php');
}

function bug_list_all() {
    global $priority_map;
    $res = db('select b.*,p.color,u.user_id,u.username,u.email from bugs as b, projects as p, users as u where b.project_id = p.project_id and b.created_by = u.user_id and b.fixed = 0 order by b.updated_time desc');


    set('priority_map',$priority_map);
    set('bugs',$res);
    return render('buglist.html.php');
}

function bug_info($id) {
    global $priority_map;
    $res = db('select b.*, u.email, u.username, p.color,p.project_title from bugs as b, projects as p, users as u where b.bug_id = '.$id.' and b.project_id = p.project_id and b.created_by = u.user_id');
    $notes = notes_for($res[0]['bug_id']);
    if(count($res) == 1) {
        set('priority_map',$priority_map);
        set('bug',$res[0]);
        set('notes',$notes);
        return render('buginfo.html.php');
    }
    else {
        ext_error('Bug id does not exist');
        return bug_list_all();
    }
}

function create_bug() {
    global $priority_map;

    $sql = 'select * from projects where closed=0 order by project_title asc';

    set('priority_map',$priority_map);
    set('projects',db($sql));
    return render('createbug.html.php');
}

function create_bug_handler() {
    $title = mysql_real_escape_string($_POST['title']);
    $sev_level = mysql_real_escape_string($_POST['severity_level']);
    $desc = mysql_real_escape_string($_POST['desc']);
    $project_id = mysql_real_escape_string($_POST['project']);

    $now = time();

    if($title == '' || $sev_level == '' || $desc == '') {
        ext_error('All fields on this page are mandatory.');
        return create_bug();
    }
    else {
        $sql = 'insert into bugs (title,description,project_id,created_time,updated_time,updated_by,severity_level,created_by) values (';
        $sql .= '"'.$title.'","'.$desc.'",'.$project_id.','.$now.','.$now.','.user('user_id').','.$sev_level.','.user('user_id').')';

        if(db($sql)) {
            $res = db('select bug_id from bugs where user_id = '.user('user_id').' order by created_time asc limit 0,1');
            $sql = 'update projects set bugs_assigned = bugs_assigned+1 where project_id = '.$project_id;
            db($sql);
            ext_log('NEW_BUG',$res[0]['bug_id'],$now);
            redirect('/');
        }
        else {
            ext_error('Sorry, there was an error inserting the information to our database.');
        }
    }
}

function update_bug() {
    $id = params('bugid');
    $severity_level = mysql_real_escape_string($_POST['severity_level']);
    $title = mysql_real_escape_string($_POST['title']);
    $description = mysql_real_escape_string($_POST['desc']);
    $notes = mysql_real_escape_string($_POST['notes']);
    $pass = true;
    $now = time();

    


    if($notes != '') {
        $sql = 'insert into notes (bug_id,note,created_time,created_by) values ('.$id.',"'.$notes.'",'.$now.','.user('user_id').')';
        if(!db($sql)) {
            $pass = false;
        }

        $sql2 = 'update bugs set updated_time = '.$now.', updated_by = '.user('user_id').' where bug_id = '.$id;
        if(!db($sql2)) {
            $pass = false;
        }
    }
    else {
        $sql = 'update bugs set severity_level = '.$severity_level.', title="'.$title.'", description = "'.$description.'",updated_time = '.$now.', updated_by='.user('user_id').' where bug_id = '.$id;
        if(!db($sql)) {
            $pass = false;
        }
    }

    if($pass) {
        ext_log('UPDATED_BUG',$id,$now);
        ext_notify('Your changes have been saved.');
    }
    else {
        ext_error('Sorry, there was an error saving your changes to this bug.');
    }

    return bug_info($id);
}

function notes_for($bugid) {
    $sql = 'select n.*, u.user_id, u.username, u.email from notes as n, users as u where n.bug_id = '.$bugid.' and n.created_by = u.user_id order by n.created_time asc';
    return db($sql);
}

function edit_bug($bugid) {
    global $priority_map;

    $sql = 'select * from bugs where bug_id = '.$bugid;
    $res = db($sql);

    set('priority_map',$priority_map);
    set('bug',$res[0]);
    return render('editbug.html.php');
}

function mark_as_fixed($bugid) {
    $now = time();
    $sql = 'update bugs set fixed = 1, updated_time = '.$now.', updated_by = '.user('user_id').' where bug_id = '.$bugid;
    if(db($sql)) {
        ext_log('CLOSED_BUG',$bugid,$now);
        ext_notify('The bug has been marked as fixed.');
    }
    else {
        ext_error('There was a problem marking this bug as fixed.');
    }

    $sql = 'select project_id from bugs where bug_id = '.$bugid;
    $res = db($sql);


    return bug_list($res[0]['project_id']);
}

function project_info($pjid) {
    if(!is_numeric($pjid)) {
        redirect('/');
    }
    $sql = 'select * from projects where project_id = '.$pjid;
    $sql2 = 'select count(*) as closed_bugs from bugs where project_id = '.$pjid.' and fixed = 1';
    $sql3 = 'select updated_time from bugs where project_id = '.$pjid.' order by updated_time desc limit 0,1';
    $res = db($sql);
    $res2 = db($sql2);
    $res3 = db($sql3);

    $res[0]['closed_bugs'] = ($res2[0]['closed_bugs'] == '')?0:$res2[0]['closed_bugs'];
    $res[0]['open_bugs'] = $res[0]['bugs_assigned'] - $res[0]['closed_bugs'];
    $res[0]['last_updated'] = $res3[0]['updated_time'];
    set('project',$res[0]);
    return render('projectinfo.html.php');
}

function project_list() {
    $project_id = params('pjid');
    if($project_id == '' || $project_id == null) {
        $sql = 'select * from projects where closed = 0 order by project_title asc';
    }
    else {
        $sql = 'select * from bugs where project_id = '.$project_id.' order by updated_time asc';
    }
    $res = db($sql);

    set('projects',$res);
    return render('projectlist.html.php');
}

function create_project() {
    return render('createproject.html.php');
}

function create_project_handler() {
    $title = mysql_real_escape_string($_POST['project_title']);
    $color = mysql_real_escape_string($_POST['color']);
    $desc = mysql_real_escape_string($_POST['project_description']);
    $now = time();

    $sql = 'insert into projects (project_title,project_desc,color,created_time) values ("'.$title.'","'.$desc.'","'.$color.'",'.$now.')';

    if(db($sql)) {

        ext_notify('Your project has been saved. You can now assign bugs to it.');
    }
    else {
        ext_error('There was a problem saving your project.');
    }

    return project_list();
}

function edit_project($pjid) {
    $sql = 'select * from projects where project_id = '.$pjid;
    $res = db($sql);

    set('project',$res[0]);
    return render('editproject.html.php');
}

function edit_project_handler($pjid) {
    $title = mysql_real_escape_string($_POST['project_title']);
    $color = mysql_real_escape_string($_POST['color']);
    $desc = mysql_real_escape_string($_POST['project_desc']);

    if($title != '' && $color != '' && $desc != '') {
        $sql = 'update projects set project_title = "'.$title.'", project_desc="'.$desc.'",color="'.$color.'" where project_id = '.$pjid;
        if(db($sql)) {
            ext_log('UPDATED_PROJECT',$pjid,time());
            ext_notify('Project details saved successfully.');
            return project_info($pjid);
        }
        else {
            ext_error('Sorry, there was a problem saving your project update.');
            set('project',array(
                'project_id' => $pjid,
                'project_title' => $title,
                'color' => $color,
                'project_desc' => $desc
            ));

            return render('editproject.html.php');
        }
    }
    else {
        ext_error('Sorry, all fields are considered mandatory.');

        set('project',array(
            'project_id' => $pjid,
            'project_title' => $title,
            'color' => $color,
            'project_desc' => $desc
        ));

        return render('editproject.html.php');
    }
}

function close_project_handler($pjid) {
    $sql = 'update projects set closed = 1 where project_id = '.$pjid;
    if(db($sql)) {
        
        ext_notify('The project has been closed.');
    }
    else {
        ext_error('Sorry, there was a problem closing the project.');
    }

    redirect('/');
}

function user_info($id) {
    $sql = 'select * from users where user_id = '.$id;
    $sql2 = 'select * from log where user_id = '.$id.' order by created_time desc limit 0,15';
    $res = db($sql);
    $res2 = db($sql2);

    set('log',$res2);
    set('user_info',$res[0]);
    return render('userinfo.html.php');
}

function user_settings() {
    return render('usersettings.html.php');
}

function user_settings_handler() {
    global $config;

    if(count($_FILES) == 0) {
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $confirm_password = mysql_real_escape_string($_POST['confirm_password']);

        if($password == $confirm_password) {
            if($password == '') {
                $password = user('password');
            }
            else {
                $password = ext_hash($password);
            }
            if(validate('email',$email)) {
                $sql = 'update users set email = "'.$email.'", password = "'.$password.'" where user_id = '.user('user_id');
                if(db($sql)) {

                    $sql = 'select * from users where user_id = '.user('user_id');
                    $res = db($sql);

                    $_SESSION[$config['session']] = serialize($res[0]);
                    ext_notify('Profile has been updated');
                }

                else {
                    ext_error('There was a problem updating your data in our database.');
                }
            }
            else {
                ext_error('The email address entered was not a valid email.');
            }
        }
        else {
            ext_error('The passwords entered do not match.');
        }
    }
    else {
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/avatars/'.md5(user('email')))) {
            if(smart_resize_image('uploads/avatars/'.md5(user('email')),100,100,true,'file')) {
                ext_notify('Avatar updated!');
            }
            else {
                ext_error('There was a problem handling your upload.');
            }
        }
        else {
            ext_error('Not a valid upload.');
        }
    }

    return user_settings();
}

/**
 * Route maps
 *
 * the routes don't actually exist for users that don't meet the designated access level
 */
dispatch('/','project_list');

dispatch('/login','login');
dispatch_post('/login','login_handler');
dispatch_post('/register','register_handler');
dispatch('/logout','logout_handler');

dispatch('/notes/:bugid', 'notes_for');

dispatch('/project', 'project_list');
if(user('access_level') == 0) {
    dispatch('/project/new', 'create_project');
    dispatch_post('/project', 'create_project_handler');
    dispatch('/project/edit/:pjid', 'edit_project');
    dispatch('/project/close/:pjid', 'close_project_handler');
    dispatch_post('/project/:pjid', 'edit_project_handler');
}
dispatch('/project/:pjid', 'project_info');

dispatch('/all', 'bug_list_all');
dispatch('/bug/new','create_bug');
dispatch_post('/bug/new','create_bug_handler');
dispatch('/bug/edit/:bugid','edit_bug');
dispatch('/bug/fix/:bugid','mark_as_fixed');
dispatch('/bug/:bugid', 'bug_info');
dispatch_post('/bug/:bugid', 'update_bug');


dispatch('/user/avatar/:email/:size','avatar');
dispatch('/user/settings','user_settings');
dispatch_post('/user/settings','user_settings_handler');
dispatch('/user/:userid','user_info'); // move to bottom of this list when all other features are completed


dispatch('/resource/avatar/:img/:size','avatar_parse');


dispatch('/:pjid', 'bug_list');
run();