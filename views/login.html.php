<div class="wrapper" id="login">

    <div id="details" style="width: 275px;">
        <h2>Login</h2>
        <form action="<?php echo url_for('/login'); ?>" method="post">
            <table class="form">
                <tr>
                    <th><label>Username: </label></th>
                    <td><input type="text" name="username" id="username"></td>
                </tr>
                <tr>
                    <th><label>Password: </label></th>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <th colspan="2"><button type="submit" class="button green">Log In</button></th>
                </tr>
            </table>
        </form>
    </div>

    <h2>Welcome</h2>
    <p>Welcome to Lemontrac, the bug-tracking system. Exterminator was built over
    the course of about 8 hours utilizing the micro-framework <a href="http://limonade-php.net">Limonade-php</a>.
    By building upon Limonade, Lemontrac serves as a very simple introductory to getting familiar with
    this excellent micro-framework. Infact, as a testament to Limonade, this application was built about
    an hour after being introduced to it.</p>
    <p>If you already have an account, go ahead and log in. If not, feel free
        to sign up for one using the form below</p>
    <p>As of March 24, 2011 Lemontrac now supports Markdown for textareas.</p>
    <p></p>

    <h2>Registration</h2>
    <form action="<?php echo url_for('/register'); ?>" method="post">
        <table class="form">
            <tr>
                <th><label>Username: </label></th>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <th><label>Password: </label></th>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <th><label>Confirm Password: </label></th>
                <td><input type="password" name="conf_password" id="conf_password"></td>
            </tr>
            <tr>
                <th><label>Email: </label></th>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <th colspan="2"><button type="submit" class="button blue">Create Account</button></th>
            </tr>
        </table>        
    </form>

    

    <div class="clear"></div>
</div>