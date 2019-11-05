
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
$port = 8889;*/


$devicetype = $_POST['devicetype'];
$hour = $_POST['hour'];
$minute = $_POST['minute'];
$second = $_POST['second'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$limit = $_POST['limit'];

//check whether there is any input in time fields
/*if (!empty($hour) && !empty($minute) && !empty($second)) {
    $time_ = $hour.":".$minute.":".$second;
}
elseif (!empty($hour) && !empty($minute) && empty($second)) {
    $time_ = $hour.":".$minute.":00";
}
elseif (!empty($hour) && empty($minute) && empty($second)) {
    $time_ = $hour.":00:00";
}*/
//if (strlen($hour) > 0) {
    $time_ = substr("000".$hour,-2).':'.substr("000".$minute,-2).':'.substr("000".$second,-2);
//}

// same for date fields
/*if (!empty($day) && !empty($month) && !empty($year)) {
    $date_ = $year."-".$month."-".$day;
}*/

//if (strlen($day) > 0 && strlen($month)>0 && strlen($year)>0 ) {
    $date_ = substr("00020".$year,-4).'-'.substr("000".$month,-2).'-'.substr("000".$day,-2);
//}

//echo "$date_ <br> $time_";

//set limit
if (empty($limit)) {
    $limit = 10;
}

$conn = new mysqli( $servername , $username , $password , $dbname ) ; // set up connection to the database on the server
if ( $conn->connect_error ) { // print out the error message if connection fails
	die ( " Connection failed : ".$conn->connect_error ) ;
}
else 
{ echo " Database connection is successful .";} // print out the successful message if connection is successful .

// SQL query dependent on user input
/*if (!isset($date_) && !isset($time_)) {
    $sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype ORDER BY rid DESC LIMIT $limit";
}
elseif (!isset($date_) && isset($time_)) {
    $sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype AND time_ >= '$time_' ORDER BY rid DESC LIMIT $limit";
}
elseif (isset($date_) && isset($time_)) {
    $sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype AND time_ >= '$time_' AND date_ >= '$date_' ORDER BY rid DESC LIMIT $limit";
}
elseif (isset($date_) && !isset($time_)) {
    $sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype AND date_ >= '$date_' ORDER BY rid DESC LIMIT $limit";
}*/
if (strlen($devicetype) > 0) {
    $sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype AND time_ >= '$time_' AND date_ >= '$date_' ORDER BY rid DESC LIMIT $limit";
}
else {
    $sql = " SELECT * FROM sensor_data_test WHERE time_ >= '$time_' AND date_ >= '$date_' ORDER BY rid DESC LIMIT $limit";
}


//$sql = " SELECT * FROM sensor_data_test WHERE did = $devicetype ORDER BY rid DESC LIMIT 10"; // select the last 10 records in decreasing order by rid in the temperature table

$result = $conn->query ( $sql ) ; // $result contains the above 10 records
if ($result->num_rows > 0) {
echo "<html > <body > <table border = '1'>"; // output table in HTML
echo "<tr><td>Row ID</td> <td> Device ID </td > <td >Date </td> <td>Time </td> <td>
Distance </td ><td> LED State </td > </tr >";
while ( $row = $result-> fetch_assoc () ) { // $row contains the next record in $result
$rid = $row["rid"];
$deviceID = $row["did"]; // $deviceID contains the value in the "did " column
$date = $row["date_"]; // $date contains the value in the " date " column
$time = $row["time_"]; // $time contains the value in the " time " column
$dist = $row["distance"]; // $temperature contains the value in the " temperature " column
$led_state = $row["led_state"]; 
echo "<tr><td> $rid </td> <td> $deviceID </td ><td>$date </td> <td >$time </td> <td>
$dist </td><td>
$led_state </td> </tr>";
}
echo " </table> </body> </html>"; }
else { echo "0 result .";}



$conn->close() ; // close the connection
?>