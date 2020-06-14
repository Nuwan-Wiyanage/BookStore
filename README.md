# BookStore
This is for Symphony framework test given by 99x Technology.

# Steps To Run the Application
1. Install PHP on your PC
2. Install PHP Composer on your PC
3. Install XAMPP on your PC
4. Go to C:\xampp\apache\conf\extra and edit the file called 'httpd-vhosts.conf' and put the below code

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/BookStore/public"
    ServerName BookStore.Test
</VirtualHost>

5. Then open Notepad as Administrator and ope the file 'C:\Windows\System32\drivers\etc\hosts' and put the below line in it

127.0.0.1 BookStore.Test

6. Then restart the Apache server from xampp and open the browser and go to below URL

http://bookstore.test/ 

7. In the terminal type 'composer require doctrine maker'
8. open the env file and change the database URl with the my sql username and password
9. then type 'php bin/console doctrine:database:create' to crate the db schema
10. then type 'php bin/console doctrine:migrations:diff' to generate the migration file
11. then type 'php bin/console doctrine:migrations:migrate' to migrate the DB

Note: Need internet access to load the font-awesome icons
	  You cann add books by click on the publish books navigation menu item 


# Assumptions

1. User level configurations are not required as per to the given scenarios. So there is no user level configuration done. (login/authentication)
2. Single table inheritance is used since it has not mentioned in the document.
3. User can see the final invoice details from the cart. 
4. You need to add some dummy coupens to coupens table in DB to redeem a coupen.
5. Only one coupen can redeem at once.
