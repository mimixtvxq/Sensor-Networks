import de.bezier.data.sql.*;
import processing.serial.*;

MySQL db; // create a mysql db object

Serial port;
int val;
// MySQL db;
//int led_status; 
//int did;
//int framerate;

void setup () {
  // frameRate(1);
  size(500, 500);
 // port = new Serial(this,"COM21",9600);
  
 // String server = "10.50.202.242"; 
 // String user = "user07";
 // String pass = "user07";
 // String database = "user07";
 // db = new MySQL(this, server, database, user, pass);
 
 //  size(200, 200); // Open the port that the board is connected to and use the same speed (9600 bps) 
  port = new Serial(this , "COM21", 9600); // The port name may be different on your computer from "COM3", // you can use println(Serial.list()); to check the port name 
  
  frameRate(1);
  
  String server = "10.50.202.242";
  String user = "user07";
  String pass = "user07";
  String database = "user07";
  
  db = new MySQL(this, server, database, user, pass);
  
  //setup drawing
  background(200);
  fill(0,0,0);
  rect(0,0,50,500);
  noStroke();
  fill(139,69,19);
  smooth();
  rect(50,150, 20, 200);
  stroke(0);
  line(400, 500, 400, 0);
  noStroke();
  fill(255,255,255);
  ellipse(400,250,40,40);
}

void draw () { 
/*   if (db.connect()) {
    // 1 frame per second
    db.query("SELECT * FROM sensor_data ORDER BY rid LIMIT 1");
    while (db.next()) {
      led_status = db.getInt("led_state"); 
      //println(led_status);
      noStroke();
      if (led_status == 1) {
        fill(255,0,0);
      } else { 
        fill(255,255,255);
      }
      ellipse(400,250,40,40);
    }
  } */ 
  
  if (0 < port.available()) {
      //String valstring = port.readStringUntil('\n'); // read the value as string and store it in valstring
     // if (valstring != null) { // remove the nullpointer exception
     // val = int(float(valstring)); // convert the string type into int type
    val = port.read();
    println(val);
    //  }
   if (val < 20) {
        fill(255,0,0);
      } else { 
        fill(255,255,255);
      }
      ellipse(400,250,40,40);
      //delay(1000);
     
      if (db.connect()){
        // insert record into db
        db.query("INSERT INTO sensor_data_test(did, date_, time_, distance, led_state) VALUES (1, CURRENT_DATE(), CURRENT_TIME(), %d, CASE WHEN %d < 20 THEN 1 ELSE 0 END)",val,val);
      }
  }
}