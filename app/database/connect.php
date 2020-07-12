
 <?php
// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);

// $conn = mysqli_connect($server, $username, $password,$db);
 $host='sql210.epizy.com';
 $user='epiz_25964457';
 $pass='xMvWYXFnm9f4';
 $db_name='epiz_25964457_post_dotcom_db';

 $conn=mysqli_connect($host, $user, $pass,$db_name);

if($conn->connect_error){
 	die('Database Connection error: ' . $conn->connect_error);
 }
 
?>