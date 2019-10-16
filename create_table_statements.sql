USE user07;

CREATE TABLE sensor_data (rid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
did INT,
time_ TIMESTAMP, -- might have to change this
distance FLOAT,
led_state INT);

-- CREATE TABLE distance (rid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
-- did INT,
-- time_ TIMESTAMP,
-- distance FLOAT);