<div class="wrapper" id="login">

    <div id="details" style="width: 275px;">
        <h2>Login</h2>
        <form action="<?php echo url_for('/login'); ?>" method="post">
            <table class="form">
                <tr>
                    <td style="text-align: right;"><label>Username: </label></td>
                    <td><input type="text" name="username" id="username"></td>
                </tr>
                <tr>
                    <td style="text-align: right;"><label>Password: </label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><button type="submit" class="button green">Log In</button></td>
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
                <td style="text-align: right;"><label>Username: </label></td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Password: </label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Confirm Password: </label></td>
                <td><input type="password" name="conf_password" id="conf_password"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label>Email: </label></td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;"><button type="submit" class="button blue">Create Account</button></td>
            </tr>
        </table>        
    </form>

    

    <div class="clear"></div>
</div>