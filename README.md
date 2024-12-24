Apache/2.4.56 (Unix) OpenSSL/1.1.1t PHP/8.0.28 mod_perl/2.0.12 Perl/v5.34.1

http://127.0.0.1:3306/


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

