Lemontrac was created as a very simple internal bug tracking system. The reason
was that most current bug tracking systems were overkill for what we needed.
Generally the projects were fairly small, and there were only one or two users
that needed to keep track bugs.

Lemontrac was built using Limonade-php micro framework, jQuery (for UI
enhancements only) and HTML/CSS. It is meant to be enjoyed by a modern browser.


## Requirements ##
The following presents the versions of software necessary to run Lemontrac

Tested on: 
PHP 5.3
MySQL 5.x


Chrome: 10
Firefox: 4.0


## Installation ##
Installing Lemontrac is fairly straight-forward. However, there is no 
"auto-install" option at this point.

1. import install.sql using your database tool of choice.
2. navigate to installation location
3. register for a new account
4. run the following sql command:

   `update users set access_level = 0 order by user_id desc limit 1`

   Since there is currently no ACL, but it IS something that is planned, users
   have an "access_level". 0 is the administrative user.

## Bugs? ##
Find any bugs? Just head over to http://lemontrac.xangelo.ca to report them.