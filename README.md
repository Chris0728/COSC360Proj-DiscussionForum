# COSC360Proj-DiscussionForum
Project Description:
Site Name (We have not figured out a name yet) is a forum website, 
which provides a platform for users to post and comment on certain topics. 
The users can make posts with texts and images, and can also like and comment on others’ posts. 
The website also displays recommended posts and top posts based on the users’ search history, which users might be interested in. 
Users can also see and edit their own profiles.


Installation guide:
●	Open the path where the xampp folder is located
●	Put “website” folder into the following path: xampp/htdoc  
●	Put “sitename_db” folder into the following path: xampp/mysql/data 
●	In xampp/php, open “php.ini”, change the settings as below: 

Default php.ini file settings:

[mail function]
; For Win32 only.
; http://php.net/smtp
SMTP = localhost
; http://php.net/smtp-port
smtp_port = 25

; For Win32 only.
; http://php.net/sendmail-from
sendmail_from = you@yourdomain

; For Unix only.  You may supply arguments as well (default: “sendmail -t -i”).
; http://php.net/sendmail-path
;sendmail_path =

Now use this snippet to change php.ini file settings:

[mail function]
; For Win32 only.
; http://php.net/smtp
SMTP=smtp.gmail.com
; http://php.net/smtp-port
smtp_port=587

; For Win32 only.
; http://php.net/sendmail-from
;sendmail_from = prcybercafes@gmail.com

; For Unix only. You may supply arguments as well (default: “sendmail -t -i”).
; http://php.net/sendmail-path
sendmail_path =”\”C:\xampp\sendmail\sendmail.exe\” -t”

●	In xampp/sendmail, change the settings as the following:
[sendmail]
smtp_server=smtp.gmail.com
smtp_port=587
smtp_ssl=tls
auth_username=****@gmail.com
auth_password=*******
force_sender=****@gmail.com
●	Launch Apache and mySQL server on xampp
●	Open a browser of your choice, then in the address bar, type: localhost/website/top.php


Walkthrough:
Please refer to “user guide.docx”

Implemented features:
Please refer to Summary of implemented features.docx

Design (Styling):
For the styling, we wanted the website to be simple with no clunky animations and such, but we still wanted it to look reasonably pleasing. Our styling mostly uses rectangular sections, which we call “blocks”, to separate sections and organize the layout easily. The background color also tends to be dim, so the colors don’t clash with each other. 

Design (Layout):
The layout is rather simple, with two main columns in the top page. To add maneuverability and simplicity, we added a header bar in almost all of the pages for users to move around easily. We have also considered the possibility that some users may have a small screen, so we made scaled elements and @media tags so when users shrink their window or have a small screen, the layout changes to best accommodate them.

Design (Back-end):
Honestly, the back-end code is messy compared to the heuristics we use when creating the front-end, because there are a lot of functions that are hard to implement and work with other functions, so a lot of time was used on testing, changing code and looking for solutions. There are also many files with meaningful names, so that we could visualize the user flow when coding individual webpages.

Files used:
1.	about.php, about-block.html, recommendation.php, recommendation-block.php, top-posts.php, top-posts-block.php:
a.	They construct the three blocks on the left column you could see in the top page, with links to posts and the statistics of the posts.
2.	admin.php:
a.	This php file is the admin-only page which allows searching for users, suspending users and deleting posts/comments.
3.	check-state.php:
a.	This file is linked to every page and is used to check if the user is logged in, suspended or an admin. 
4.	confirm-password.php, confirm-remove-search.php, confirm-signup.php:
a.	These simple pages are to notify users their actions were successful.
5.	create-comment.php, create-post.php:
a.	These pages let you create comments and posts by giving you forms to fill
6.	header.php:
a.	The header bar, which provides links to go to just about everywhere for the user.
7.	like.php, unlike.php, likeComment.js, likePost.js:
a.	These files are responsible for the implementation of users liking a post.
8.	login.php, logout.php:
a.	These are used to get the user logged in and out of the website by using server-side validation.
9.	mailto.php, recovery.php:
a.	These enable the password recovery function, where the user gives their email, and the server sends an automated email to the user.
10.	password-edit.php, profile-edit.php, remove-search.php:
a.	Provides their respective functions for users to give them more control of their own data.
11.	post.php:
a.	The page where a user can see a post and its comments
12.	profile.php:
a.	The user’s profile page, currently users can only see their own profiles
13.	search.php, record-search.php: 
a.	This lets users search for posts using keywords or categories and records users’ search terms, given they are logged in
14.	show-comment.php, show-post.php, show-search.php:
a.	These files control the display and the format of their respective items
15.	signup.php: 
a.	Users can create new accounts here
16.	style-links.php:
a.	This php compiles all general-purpose links and includes, then is used on almost every other webpage
17.	suspend-user.php:
a.	This is a page where suspended users get directed to
18.	top.php:
a.	The main page of the website which lets you browse posts
19.	unauthorized.php: 
a.	Users get redirected here when trying to access off-limits pages
20.	unknown-user.php: 
a.	Fail-safe page; when users have session data but does not fit any users, they will be redirected to this page
21.	userterms.html: 
a.	Placeholder page for terms of use
22.	validate-comment.php, validate-password.php, validate-post.php, validate-profile.php, validate-signup.php:
a.	These validate data given by users and send them to the server database

Known Limitations/Issues:
●	Repeated posts may appear in top.php when other users send submit a new post (See Summary of implemented features)
●	Website reuses many portions of code, so there are many unnecessary files made
●	Users can only see their own profiles
