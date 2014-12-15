<?php
/* This is an example on how to import all old PS customers as subscribers to the WP DB.
 * Your old Prestashop table should have been imported alongside your new and shiny WP table
 * Obviously, there is no guarantee, please check everything for yourself BEFORE executing this code.
 * You need to save this file as import.php and put it in an accessible location yoursite/import.php, for example.
 * Do not forget to delete the file afterwards for security reasons.
 */
// CONFIGURE HERE
$db_user = "root";
$db_pass = "";
$db_host = "localhost"; // mostly "localhost"
$db_name = "lwb_db";

// // Create connection
// $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// $sql = "SELECT * FROM pr_customer";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         print_r($row);
//     }
// } else {
//     echo "0 results";
// }
// $conn->close();



// CONNECT TO DB
$link = mysql_connect($db_host, $db_user, $db_pass);
if (!$link) {
		die('Connection failed : ' . mysql_error());
}
mysql_select_db($db_name);
@mysql_query("SET CHARACTER SET 'utf8'");
@mysql_query("SET character_set_results = NULL");
mysql_query("SET group_concat_max_len = 10240;");

// SELECT USERS FROM PRESTASHOP TABLE
$q = mysql_query("SELECT * FROM pr_customer");
$i = 0;

while ($user = @mysql_fetch_assoc($q)) {
	if($user['deleted'] == 0 AND $user['id_customer'] > 1) {
		$new[$i] = array(
			"ID" => $user['id_customer'],
			"user_login" => clean($user['firstname'].$user['lastname']), // please verify that there are no doubles in your DB afterwards.
			"user_pass" => $user['passwd'],
			"user_nicename" => clean($user['firstname'].$user['lastname']),
			"user_email" => $user['email'],
			"user_url" => "",
			"user_registered" => $user['date_add'],
			"user_activation_key" => "", // if users should not be activated yet, you should fill in this field with a valid activation key.
			"user_status" => "0",
			"display_name" => clean($user['firstname'].$user['lastname'])
		);

		$uid = mysql_real_escape_string($user['id_customer']);

		// first name and lastname go to wp_usermeta table
		if(!empty($user['firstname']))  {
			$fn =  mysql_real_escape_string($user['firstname']);
			mysql_query ("INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (\"\", \"$uid\", \"first_name\", \"$fn\");");
		}
		if(!empty($user['lastname']))  {
			$ln =  mysql_real_escape_string($user['lastname']);
			mysql_query ("INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (\"\", \"$uid\", \"last_name\", \"$ln\");");
		}

		// user level and subscriber status go to wp_usermeta table
		mysql_query ("INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (\"\", \"$uid\", \"wp_user_level\", \"0\");");
       	mysql_query ("INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (\"\", \"$uid\", \"wp_capabilities\", \"a:1:{s:10:\"subscriber\";b:1;}\");");

		$i++;

		// the other infos, like email and registration date, go to the wp_user table
		$table = "wp_users";
		foreach ($new as $n) {
			$keys ="";
			$vals ="";
			foreach ($n as $k => $v) {
				$v = mysql_real_escape_string($v);
				$keys .= "`$k`, ";
				$vals .= "\"$v\", ";
			}
			$keys = rtrim($keys, ", ");
			$vals = rtrim($vals, ", ");
			mysql_query("INSERT INTO `$table` ($keys) VALUES ($vals);");
		}
	}
}
mysql_close($link);

function clean($string) {
	setlocale(LC_ALL, 'fr_FR'); // adjust this to your needs
	$string = iconv("UTF-8", "ASCII//IGNORE", $string); // french, this will delete accents from names
	$string = strtolower(str_replace(" ", "", $string));
	return $string;
};
?>
