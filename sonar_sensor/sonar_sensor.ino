// This program gets the proximity data from an Arduino sonar sensor and sends it to the another Arduino using xBee
// We include the Software serial library in order to send data to the other Arduino
# include <SoftwareSerial.h>

// xBee Transmitter Tx and Rx ports
short xBeeTx = 11;
short xBeeRx = 12;

// We define the xBeeSerial object
SoftwareSerial xBeeSerial(xBeeRx, xBeeTx);

// Digital output used for the proximity sensor
const int trig = 7;
// Digital input used for the proximity sensor
const int echo = 6;

// Code setup
void setup (){
  
  pinMode(trig, OUTPUT );
  pinMode(echo, INPUT );
  digitalWrite(trig, LOW);
  Serial.begin(9600);

  // We begin xBee serial communication using baud rate 9600
  xBeeSerial.begin (9600) ;
  
}// End void setup ()

// Code loop
void loop ()
{
  // send an impulse to trigger the sensor start the measurement
  digitalWrite(trig , HIGH );
  delayMicroseconds(15) ; // minimum impulse width required by HC -SR4 sensor
  digitalWrite (trig , LOW);
  
  long duration = pulseIn (echo , HIGH );
  // this function waits for the pin to go HIGH ,
  // starts timing , then waits for the pin to go LOW and stops timing .
  // Returns the length of the pulse in microseconds
  
  // 'duration ' is the time it takes sound from the transmitter back
  // to the receiver after it bounces off an obstacle
  const long vsound = 340; // [m/s]
  
  long dist = ( duration / 2) * vsound / 10000; // 10000 is just the scaling factor to get the result in [cm]

  // We send the response
  String response = "";
  
  if ( dist > 500 || dist < 2){ 

    // We set the response as invalid range
    response = "Invalid range !";
    // We send the response through serial communication
    Serial.println (response);
    // We send the data to through xBee serial
    xBee Serial.println(response);
    
  }// End if ( dist > 500 || dist < 2)
  else {

    // We set the response as distance in centimeters
    response = dist + " cm";

    // We send the response through serial communication
    Serial.println (response);
    // We send the data to through xBee serial
    xBee Serial.println(response);
    
  }// End else

  // We wait for 1 second for 
  delay (1000) ;
  
}//End void loop
