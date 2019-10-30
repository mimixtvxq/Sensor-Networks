
<?php
$servername ="localhost"; // the IP address of your server
$username = "root" ; // your user name to access the database
$password = "root" ; // your password to access the database
$dbname = "data_acquisition_db" ; // the database which is already created on the server
$port = 3307;


$did = $_POST['did'];
$temperature = $_POST['temperature'];
$devicetype = $_POST['devicetype'];

$conn = new mysqli( "$servername:$port" , $username , $password , $dbname ) ; // set up connection to the database on the server
if ( $conn->connect_error ) { // print out the error message if connection fails
	die ( " Connection failed : ".$conn->connect_error ) ;
}
else 
{ echo " Database connection is successful .";} // print out the successful message if connection is successful .

$sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype ORDER BY rid DESC LIMIT 10"; // select the last 10 records in decreasing order by rid in the temperature table
$result = $conn->query ( $sql ) ; // $result contains the above 10 records
if ( $result->num_rows > 0) {
echo "<html > <body > <table border = '1'>"; // output table in HTML
echo "<tr><td>Row ID</td> <td> Device ID </td > <td >Date </td> <td>Time </td> <td>
Distance </td ><td> LED State </td > </tr >";
while ( $row = $result-> fetch_assoc () ) { // $row contains the next record in $result
$rid = $row["rid"];
$deviceID = $row["did"]; // $deviceID contains the value in the "did " column
$date = $row["date_"]; // $date contains the value in the " date " column
$time = $row["time_"]; // $time contains the value in the " time " column
$dist = $row["dist_"]; // $temperature contains the value in the " temperature " column
$led_state = $row["led_state"]; 
echo "<tr><td> $rid </td> <td> $deviceID </td ><td>$date </td> <td >$time </td> <td>
$dist </td><td>
$led_state </td> </tr>";
}
echo " </table> </body> </html>"; }
else { echo "0 result .";}



$conn->close() ; // close the connection
?>