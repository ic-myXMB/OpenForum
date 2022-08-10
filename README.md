# OpenForum

OpenForum Details:

OpenForum at: https://github.com/ic-myXMB/OpenForum/tree/main/OpenForum

Notice: This project is submitted and shared "AS IS" in the hopes that folks may find it of some use and hopefully see it as a starting point to continue on with further and improve upon.

This project uses:

* Bootstrap 5.2 beta

* Light Switch 0.1.4

* Font Awesome 6.1.1

* TinyMCE 6.0.3 

About:

This simple project is a very basic forum project started after reading an old tutorial by Julie Meloni from say around 2009 or so. For this project we are using bootstrap 5, font awesome 6, php and mysql as well it also has bootstrap light & dark switch mode. This very basic forum is without users or any sort of control panel. It primarily is an open forum that allows you to by submitting your email as your username to either post a topic and first post at once for such. Also as well then after it allows one to reply to those topics. Also for this basic forum it is primarily setup in the following structure of one single forum that contains topics and then posts / replies to such topics. (As this simple forum is without such features as users, user login or admin control, and as such is an open forum,  this is why it is called OpenForum.) 

Note: This is not in the format of say categories, then topics, then posts type setup, but I might add a variant of this that adds such if and or when my free time may allow * ( added such in directory called OpenForum2 at: https://github.com/ic-myXMB/OpenForum/tree/main/OpenForum2 ). 

As noted already for this setup it is simply presented in the format of one Forum / "category" then topics within that and posts for such. Hopefully that makes sense.


OpenForum Instructions:

OpenForum at: https://github.com/ic-myXMB/OpenForum/tree/main/OpenForum 

Setup:

upload files contained within the "Upload" directory:

Edit:

    config/connect.php


you only need to edit this:

// edit testUser, testPassword, testDB to reflect your details

// connect to server and select database

    $mysqli = $mysqli_connect("localhost", "testUser", "testPassword", "testDB");


* to reflect your database user name , your database name and your database user password.


then you need to install database tables:

In your browser visit:

    db-install.php

to install the db tables.

That is it! Simple enough, right?! Hopefully you may find such of interest or usage.

Best of luck!

-----------------------------------------------------------------------


OpenForum2 Details:

OpenForum2 at: https://github.com/ic-myXMB/OpenForum/tree/main/OpenForum2

OpenForum2:

(OpenForum2 is the category, topics & posts variant expanded upon from the initially shared "OpenForum" that only had topics and posts.)

Notice: This project is submitted and shared "AS IS" in the hopes that folks may find it of some use and hopefully see it as a starting point to continue on with further and improve upon.

This project uses:

Bootstrap 5.2 beta

Light Switch 0.1.4

Font Awesome 6.1.1

TinyMCE 6.0.3 

About:

This simple project is a very basic forum project started after reading an old tutorial by Julie Meloni from say around 2009 or so. For this project we are using bootstrap 5, font awesome 6, php and mysql as well it also has bootstrap light & dark switch mode. This very basic forum is without users or any sort of control panel. It primarily is an open forum that allows you to by submitting your email as your username to either post a category, topic and first post at once for such. Also as well then after it allows one to reply to those topics. Also for this basic forum it is primarily setup in the following structure of categories in the forum that contain topics and then posts / replies to such topics. (As this simple forum is without such features as users, user login or admin control, and as such is an open forum,  this is why it is called OpenForum2.) 


OpenForum2 Instructions:

OpenForum2 at: https://github.com/ic-myXMB/OpenForum/tree/main/OpenForum2

Setup:

upload files contained within the "Upload" directory:

Edit:

    config/connect.php


you only need to edit this:

// edit testUser, testPassword, testDB to reflect your details

// connect to server and select database

    $mysqli = $mysqli_connect("localhost", "testUser", "testPassword", "testDB");


* to reflect your database user name , your database name and your database user password.


then you need to install database tables:

In your browser visit:

    db-install.php

to install the db tables.

That is it! Simple enough, right?! Hopefully you may find such of interest or usage.

Best of luck!
