Apache/2.4.56 (Unix) OpenSSL/1.1.1t PHP/8.0.28 mod_perl/2.0.12 Perl/v5.34.1


Manually Change Ownership Inside the Container after the  first deployment (php-fpm):

Execute the following commands inside the container to change the ownership of the uploads directory to www-data:

sh
chown -R www-data:www-data /var/www/html/uploads
chmod -R 777 /var/www/html/uploads


data base connection function

function getBdd()
{
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'klando';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: 'giress';

    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $bdd;
}


the only difference with this version from the development version is in this code (wherever this line is found)
 in covago_app repository on github : $bdd = new PDO('mysql:host=mysql;dbname=covago_db', 'covago_user1', 'WryJPUnZ8_tN');
 online(CPanel): $bdd = new PDO('mysql:host=localhost;dbname=covago_db', 'covago_user1', 'WryJPUnZ8_tN');

#38b6ff
#7ed957