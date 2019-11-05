
<?php


$servername ="10.50.202.242"; // the IP address of your server
$username = "user07" ; // your user name to access the database
$password = "user07" ; // your password to access the database
$dbname = "user07" ; // the database which is already created on the server


 // FOR LOCAL TESTING
/*$servername ="localhost"; // the IP address of your server
$username = "root" ; // your user name to access the database
$password = "root" ; // your password to access the database
$dbname = "user07" ; // the database which is already created on the server
$port = 8889; */

$conn = new mysqli( $servername , $username , $password , $dbname ) ; // set up connection to the database on the server
if ( $conn->connect_error ) { // print out the error message if connection fails
	die ( " Connection failed : ".$conn->connect_error ) ;
}
else 
{ /*echo " Database connection is successful .";*/} // print out the successful message if connection is successful .

$sql = " SELECT distance,led_state FROM sensor_data_test ORDER BY rid DESC LIMIT 1"; //query the last values for led_state and distance

$result = $conn->query ( $sql ) ; // $result contains the above 10 records
if ($result->num_rows > 0) {
while ( $row = $result-> fetch_assoc () ) { // $row contains the next record in $result
$dist = $row["distance"];
$led_state = $row["led_state"];


echo json_encode(array($led_state, $dist));
}}
else { /*echo "0 result .";*/}



$conn->close() ; // close the connection
?>