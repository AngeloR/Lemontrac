<div class="wrapper" id="login">

    <h2>Auto-Installer</h2>
    <div id="details">
        <h2>Warning</h2>
        <p>The AutoInstaller is currently a test feature for Lemontrac. If all goes well
            you should be seeing it in version 0.2.</p>
        <p>If you already have an installation of Lemontrac please backup your database incase
            something goes wrong while using the uninstaller. It has been tested but we are still
            in the process of finding any bugs that may be present.</p>
        <p>You are using the Lemontrac AutoInstaller at your own risk.</p>
        <h3>Backup your data before attempting this!</h3>
    </div>
    <p>The AutoInstaller allows you to easily setup an instance of Lemontrac within a
        MySQL environment.</p>
    <p></p>
    <h3>Database Connection</h3>
    <p>Set up your database connection so that Lemontrac can create the necessary database and
        tables for your first installation.</p>
    <form action="<?php echo url_for('/install'); ?>" method="post">
        <table class="form">
            <tr>
                <th><label>Host: </label></th>
                <td><input type="text" name="db_host" id="db_host" value="localhost"></td>
            </tr>
            <tr>
                <th><label>Username: </label></th>
                <td><input type="text" name="db_user" id="db_user"></td>
            </tr>
            <tr>
                <th><label>Password: </label></th>
                <td><input type="password" name="db_pass" id="db_pass"></td>
            </tr>
            <tr>
                <th><label>Database Name: </label></th>
                <td><input type="text" name="db_name" id="db_name"></td>
            </tr>
        </table>
        <p></p>
        <h3>Administrative Account</h3>
        <p>If you'd like, you can set up the administrative account for Lemontrac by filling
            in the form below. If you choose not to do this, the default username and password
            is "admin" (without the quotes).</p>
        <table class="form">
            <tr>
                <th><label>Username:</label></th>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <th><label>Password: </label></th>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <th><label>Confirm Password: </label></th>
                <td><input type="password" name="confirm_password" id="confirm_password"></td>
            </tr>
            <tr>
                <th><label>Email:</label></th>
                <td><input type="text" name="email" id="email"></td>
            </tr>
        </table>

        <button type="submit" class="button blue">Install Lemontrac</button>
    </form>
    <p></p>
    <div class="clear"></div>
</div>