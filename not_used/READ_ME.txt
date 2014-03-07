Unpack this zip file.  Make sure they are all in the same folder/directory, when you upload them to your server.

Changes need to be made to suggest_zip.php.  You need to modify the mysql_connect and mysql_select_db statements.

mysql_connect is how PHP connects to your mysql database.  You need to change the server location, the username, and the password in order to make the connection.

mysql_select_db selects the database to use, once PHP connects to the database server.  You need to change the value saved as 'database_name' to whatever the database name is for your website.

jQuery is bundled with this.  It's important to note that jQuery is constantly changing, so you may want to download the up-to-date sources from jquery's website: http://docs.jquery.com/Downloading_jQuery and http://jqueryui.com/download

The ZipCode database table is bundled with this.  You can install it a couple different ways that I know of.
	1) Use PHPMyAdmin

	2) Use mysql-cli
		connect to server via SSH: ssh user@mydomain.com

		connect to mysql server: mysql -u username -p

		type your password

		select your database: use database_name;

		execute the file: \. /path/to/zipcode.sql



----
Anthony Matarazzo

Use my blog for questions or comments: http://www.htmlblog.us/jquery-autocomplete

Keep it locked for future articles.

Check out our sister site: http://www.phpblog.us
