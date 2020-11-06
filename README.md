# CPS-4301-SIT
This is an informational website focused on displaying services provided and a ticketing system to manage current and past orders.

# XAMPP set up 
XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. It is available for Linux, Windows and Mac OS environments. We will use this software to run our program locally.
After following the installation steps after downloading XAMPP from https://www.apachefriends.org/index.html 
After successfully installing XAMPP the database has to be configured
Under Settings press on Create Database and create your database 
to change the login information for your database go to phpMyAdmin if phpMyAdmin is not working:

Click Explorer to the right in the XAMPP Control Panel.

Open the "phpMyAdmin" folder.

Open the "config.inc.php" file in NotePad or another text editor.

Change "config" to "cookie" next to "$cfg['Servers'][$i]['auth_type'] = 'config';"

Change "true" to "false" next to "On $cfg['Servers'][$i]['AllowNoPassword'] = true;"

Click File.

Click Save.

Once XAMPP is installed and MariaDB is working we can create manage our database

# Database set up

in phpMyAdmin we can import directly into the database we created the file table_sql.php or copy and paste into the query field.

# Execution 

Once the files are loaded into XAMPP and the database was created, you can access the files using a web browser and entering the url localhost:8080/index.html
this will be the landing page where all the information will be displayed
to log in into the ticketing system go to localhost:8080/login.html
log in with the credentials already created in table_sql.php or create your own. 
after successfully login in it will redirect you to home_page.php where you will be able to see all the tickets that are in the database as well as create your own.

## Ticket creation

Tickets are automatically created by users who submit a form in index.html, the ticket will go into the database and the ticket can be viewed in home_page.php once there is up to the administrators decision to accept or delete the newly user-created ticket, if the administrator decides to accept the ticket it can complete the ticket by filling up information such as phone number, description and change the status of the ticket from "New" to "In progress".
Inside home_page.php the administrator can also create tickets by clicking on the +ticket button. Once clicked a form will pop up where the information of the ticket can be filled up. the only required data field is email, a ticket can be created by inserting an email alone.

## Ticket filtering

Tickets can be filtered by Status and also tickets can be searched by searching the name associated with the ticket.
