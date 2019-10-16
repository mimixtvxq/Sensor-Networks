import de.bezier.data.sql.*;

//MySQL db;
int led_status; 
int did;
//int framerate;

void setup () {
  frameRate(1);
  size(500, 500);
  //String server = "10.50.202.242"; 
  //String user = "user07";
  //String pass = "user07";
  //String database = "user07";
  //db = new MySQL(this, server, database, user, pass);
}
void draw () { 
  //if (db.connect()) {
    // 1 frame per second
  //  db.query("SELECT led_status FROM table ORDER BY rid DESC LIMIT 1
  //  while (db.next()) {
  //    led_status = db.getInt("led_status"); 
  //    println(temperature);
    //}
  //}
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
  if (led_status == 1) {
    fill(255,0,0);
  }
  else { 
    fill(255,255,255);
  }
  ellipse(400,250,40,40);
}
