import processing.serial.*;
import de.bezier.data.sql.*;

MySQL db; // create a mysql db object

Serial port; // Create object from Serial class 
int val; // Data received from the serial port

void setup() { 
  size(200, 200); // Open the port that the board is connected to and use the same speed (9600 bps) 
  port = new Serial(this , "COM5", 9600); // The port name may be different on your computer from "COM3", // you can use println(Serial.list()); to check the port name 
  
  frameRate(1);
  
  String server = "10.50.202.242";
  String user = "user07";
  String pass = "user07";
  String database = "user07";
  
  db = new MySQL(this, server, database, user, pass);
}

  void draw() { 
    if (0 < port.available()) { // If data is available , 
      String valstring = port.readStringUntil('\n'); // read the value as string and store it in valstring
      if (valstring != null) { // remove the nullpointer exception
         val = int(float(valstring)); // convert the string type into int type
         println(val);
      }

      if (db.connect()){
        // insert record into db
        db.query("INSERT INTO sensor_data_test(did, date_, time_, distance, led_state) VALUES (1, CURRENT_DATE(), CURRENT_TIME(), %d, CASE WHEN %d > 0 THEN 1 ELSE 0 END)",val,val);
      }
    }   
  }
