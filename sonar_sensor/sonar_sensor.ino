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

// LED output, this will serve as an alert that the proximity threshold has been trespassed
const int LED = 8;
// LED Threshold, this is the max distance that an object can be from the sensor without triggering an alert
const int threshold = 20;

// Code setup
void setup (){

  // We setup the pins for the proximity sensor
  pinMode(trig, OUTPUT);
  pinMode(echo, INPUT);
  digitalWrite(trig, LOW);
  // We initialize the serial communication
  Serial.begin(9600);

  // We setup the LED as output
  pinMode(LED, OUTPUT);
  
  // We begin xBee serial communication using baud rate 9600
  xBeeSerial.begin(9600) ;
  
}// End void setup ()

// Code loop
void loop ()
{
  // send an impulse to trigger the sensor start the measurement
  digitalWrite(trig , HIGH);
  delayMicroseconds(15) ; // minimum impulse width required by HC -SR4 sensor
  digitalWrite(trig , LOW);
  
  long duration = pulseIn (echo , HIGH);
  // this function waits for the pin to go HIGH ,
  // starts timing , then waits for the pin to go LOW and stops timing .
  // Returns the length of the pulse in microseconds
  
  // 'duration ' is the time it takes sound from the transmitter back
  // to the receiver after it bounces off an obstacle
  const long vsound = 340; // [m/s]
  
  long dist = ( duration / 2) * vsound / 10000; // 10000 is just the scaling factor to get the result in [cm]
  
  if ( dist > 500 || dist < 2){ 

    // We set the response as invalid range, in this case -1
    dist = -1;
    // We send the response through serial communication, this is to check locally that sensor data is being collected
    Serial.println (dist);
    // Now we send the data to through xBee serial
    xBeeSerial.println(dist);
    
  }// End if ( dist > 500 || dist < 2)
  else {

    // We turn on/off the LED based on the response
    if (threshold > dist){
      // We turn on the light
      digitalWrite (LED , HIGH);
      // We send the response through serial communication
      Serial.println (dist);
      // We send the distance data to receiver Arduino through xBee serial communication
      xBeeSerial.println(dist);
    
    } else {
      
      // The light remains off, no data is sent
      digitalWrite(LED , LOW);
      
    }// End else
    
  }// End else
  
}//End void loop
