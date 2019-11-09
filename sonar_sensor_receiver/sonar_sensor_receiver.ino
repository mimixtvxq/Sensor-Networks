// This program receives the proximity sensor data from an Arduino sonar sensor and displays it on the serial monitor
// We include the Software serial library in order to receive data from another Arduino
# include <SoftwareSerial.h>

// String were we'll store the receive data
String receive;

// xBee Transmitter Tx and Rx ports
short xBeeTx = 11;
short xBeeRx = 12;

// LED output, this is to know that the data is being received by the xBee receiver.
const int LED = 8;

// We define the xBeeSerial object
SoftwareSerial xBeeSerial(xBeeRx, xBeeTx);

// Code setup
void setup (){

  // We setup the serial port transmission for both Serial and xBee Serial
  Serial.begin(9600);
  xBeeSerial.begin(9600) ;

  // We setup the LED output
  pinMode(LED, OUTPUT);
  
}// End void setup ()

// Code loop
void loop (){
  // If we receive data we print it out and also turn on a Green LED.
  if (xBeeSerial.available() > 0){

    // Turn on the LED, meaning that the data is being received.
    digitalWrite(LED , HIGH);
    receive = xBeeSerial.readStringUntil('\n'); // read in data as a String
    // We print this data in the serial monitor
    Serial.println(receive);
    
  }// End if (xBeeSerial.available() > 0)
  else {
    
    // The light remains off, no data is sent
    digitalWrite(LED , LOW);
    
  }// End else
  
}//End void loop ()
