<?php

// current levels of priority
$priority_map = array('Critical','High','Medium','Low');
$access_levels = array('Admin','User');

$events = array(
    'NEW_BUG'           => 'created a bug',
    'UPDATED_BUG'       => 'updated a bug',
    'CLOSED_BUG'        => 'closed a bug',
    'NEW_NOTE'          => 'added a note',
    'NEW_PROJECT'       => 'created a project',
    'UPDATED_PROJECT'   => 'updated a projects details',
    'REGISTERED_USER'   => 'registered their account'
);

function db($sql) {
    $q = mysql_query($sql) or die(mysql_error());

    if(mysql_num_rows($q) > 0) {
        $tmp = array();
        while($r = mysql_fetch_assoc($q)) {
            $tmp[] = $r;
        }
        return $tmp;
    }
    else {
        return $q;
    }
}

function ext_log($type,$id,$time,$message = '') {
    global $events;

    $event_key = array_search($type,array_keys($events));
    $sql = 'insert into log (user_id,update_type,message';

    switch($event_key) {
        case 0:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,bug_id,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$id.','.$time.')';
            break;
        case 1:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,bug_id,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$id.','.$time.')';
            break;
        case 2:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,bug_id,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$id.','.$time.')';
            break;
        case 3:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,project_id,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$id.','.$time.')';
            break;
        case 4:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,project_id,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$id.','.$time.')';
            break;
        default:
            $message = ($message == '')?$events[$type]:$message;
            $sql = 'insert into log (user_id,update_type,message,created_time) values ('.user('user_id').','.$event_key.',"'.$message.'",'.$time.')';
            break;
    }
    db($sql);
}

function validate($type,$value) {
    switch($type) {
        case 'email':
            return eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$',$value);
            break;
    }
}

function ext_notify($msg = null) {
    static $messages;

    if($msg == null) {
        $s = $messages;
        $messages = array();
        return $s;
    }
    else {
        if($messages == null) {
            $messages = array();
        }

        $messages[] = $msg;
    }
}

function ext_error($msg = null) {
    static $errors;

    if($msg == null) {
        $s = $errors;
        $errors = array();
        return $s;
    }
    else {
        if($errors == null) {
            $errors = array();
        }

        $errors[] = $msg;
    }
}

function ext_notice_render() {
    $errors = ext_error();
    $messages = ext_notify();

    $tmp = array();

    foreach($messages as $i=>$msg) {
        $tmp[] = '<div class="good">'.$msg.'</div>';
    }

    foreach($errors as $i=>$error) {
        $tmp[] = '<div class="error">'.$error.'</div>';
    }

    if(count($tmp) < 1) {
        return '';
    }

    return '<div class="notices">'.implode("\r\n",$tmp).'</div>';
}
?>
