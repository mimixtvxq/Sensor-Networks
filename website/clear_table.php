
<?php
$servername ="10.50.202.242"; // the IP address of your server
$username = "user07" ; // your user name to access the database
$password = "user07" ; // your password to access the database
$dbname = "user07" ; // the database which is already created on the server

$port = 22;

/*  // FOR LOCAL TESTING
$servername ="localhost"; // the IP address of your server
$username = "root" ; // your user name to access the database
$password = "root" ; // your password to access the database
$dbname = "data_acquisition_db" ; // the database which is already created on the server
$port = 3307;
*/


$conn = new mysqli( "$servername:$port" , $username , $password , $dbname ) ; // set up connection to the database on the server
if ( $conn->connect_error ) { // print out the error message if connection fails
	die ( " Connection failed : ".$conn->connect_error ) ;
}
else 
{ echo " Database connection is successful .";} // print out the successful message if connection is successful .

$sql = "TRUNCATE sensor_data_test";  // delete values from table
if ( $conn->query ( $sql ) === TRUE ) { // use this SQL to query the databse
echo "The database has been cleared!";
} else {
echo " Error : ".$sql."<br>".$conn->error ; // print out the error message if the query fails
}


$conn->close() ; // close the connection
?>