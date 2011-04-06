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
        MySQL environment. Please ensure that BEFORE you click the Install Lemontrac button
    that you have already configured the appconfig.ini file as necessary. </p>
    <p></p>
    <h3>Configuring the appconfig.ini file</h3>
    <p>Configuring the appconfig.ini file is fairly straight forward. If you want a more detailed
        explanation of what everything does PLEASE refer to the online documentation.</p>
    <ol>
        <li>Copy <span class="code">appconfig.sample.ini</span> and rename it to appconfig.ini</li>
        <li>Open appconfig.ini and setup the database options.</li>
    </ol>

    <p></p>
    <p>If you have configured your appconfig.ini file, you can go ahead with the Lemontrac installation.
        If successful, you will be taken to the login page where you can login with the following credentials: <br>
        <b>Username: </b><i>admin</i>
        <b>Password: </b><i>admin</i></p>
    <p>Your password and the email address associated with your account can be changed after you log in.</p>
    <p></p>
    <h3>Alright, go ahead and Install Lemontrac!</h3>
    <p></p>
    <form action="<?php echo url_for('/install'); ?>" method="post">
        <button type="submit" class="button blue">Install Lemontrac</button>
    </form>
    <p></p>
    <div class="clear"></div>
</div>