### Installation instructions

- Clone or download the current repository locally
- Create a new Virtual Host in your vhosts config file
<br />Example Apache httpd-vhosts configuration:
```
<VirtualHost *:80>
    DocumentRoot "/var/www/bc-demo/public"
</VirtualHost>
```
- Paste the code to your webserver directory
- Create a new database named `bc_ftaras_demo`
- Import the `bc_ftaras_demo.sql` file to the newly created database
- Update the database credentials in `confing/auth.ini`

------------
