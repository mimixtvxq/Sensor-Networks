// This program receives the proximity sensor data from an Arduino sonar sensor and displays it on the serial monitor
// We include the Software serial library in order to receive data from another Arduino
# include <SoftwareSerial.h>

// String were we'll store the receive data
String receive;

// xBee Transmitter Tx and Rx ports
short xBeeTx = 11;
short xBeeRx = 12;

// We define the xBeeSerial object
SoftwareSerial xBeeSerial(xBeeRx, xBeeTx);

// Code setup
void setup(){
  
  Serial.begin(9600);
  xBeeSerial.begin(9600) ;
  
}// End void setup ()

// Code loop
void loop(){

  // If we receive data we print it out.
  if (xBeeSerial.available() > 0){
    receive = xBeeSerial.readStringUntil('\n'); // read in data as a String
    //int receiveInt = receive.toInt(); // convert a String into an integer
    Serial.println(receive);
  }// End if (xBeeSerial.available() > 0)
  
}//End void loop ()
