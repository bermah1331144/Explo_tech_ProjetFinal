#Ce sont les logiciels qui sera utiliser pour les sensor 
import RPi.GPIO
from machine import Pin
import time
from w1thermsensor import W1ThermSensor
import RPi.GPIO as GPIO
from time import sleep
import spidev

#Code pour la LED RGB

LED_R_PIN = 13
LED_G_PIN = 12
LED_B_PIN = 18
GPIO.setmode(GPIO.BCM)
GPIO.setup([LED_R_PIN, LED_G_PIN, LED_B_PIN],GPIO.OUT)
RED = GPIO.PWM(LED_R_PIN, 1000)
GREEN = GPIO.PWM(LED_G_PIN, 1000)
BLUE = GPIO.PWM(LED_B_PIN, 1000)






##Ceci permet de voir si y du son
SOUND_SENSOR_PIN = 7 


GPIO.setmode(GPIO.BCM)
GPIO.setup(SOUND_SENSOR_PIN, GPIO.IN)

prev_sound_state = GPIO.input(SOUND_SENSOR_PIN)

try:
    while True:
        # Read the current state of the sound sensor
        sound_state = GPIO.input(SOUND_SENSOR_PIN)

        # Check for a state change (LOW to HIGH or HIGH to LOW)
        if sound_state != prev_sound_state:
            if sound_state == GPIO.LOW:
                print("Sound detected!")

        # Update the previous state variable
        prev_sound_state = sound_state

        # Add a small delay to prevent continuous readings
        sleep(0.1)

except KeyboardInterrupt:
    # Clean up GPIO settings when Ctrl+C is pressed
    GPIO.cleanup()
    print("\nExiting the program.")




#Code pour prendre la temperature
temperature_c_froid = 1
temperature_f_froid = 33

temperature_c_tiede = 18
temperature_f_tiede = 64

temperature_c_chaud = 23
temperature_f_chaud = 73

def find_ds18b20_sensor():
    for sensor in W1ThermSensor.get_available_sensors():
        if sensor.type == W1ThermSensor.THERM_SENSOR_DS18B20:
            return sensor
    return None

# Read temperature from the sensor
def read_temperature(sensor):
    temperature_celsius = sensor.get_temperature()
    temperature_fahrenheit = sensor.get_temperature(W1ThermSensor.DEGREES_F)
    return temperature_celsius, temperature_fahrenheit

# Find DS18B20 sensor
ds18b20_sensor = find_ds18b20_sensor()

if ds18b20_sensor is not None:
    print(f"DS18B20 Sensor found: {ds18b20_sensor.id}")

    try:
        while True:
            # Read temperature
            temperature_c, temperature_f = read_temperature(ds18b20_sensor)
            
            print(f"Temperature: {temperature_c:.2f}°C | {temperature_f:.2f}°F")
            if temperature_f | temperature_c <= temperature_f_froid | temperature_c_froid : 
                GPIO.setup([LED_B_PIN],GPIO.HIGH)
            if temperature_f | temperature_c == temperature_f_tiede | temperature_c_tiede :
                GPIO.setup([LED_G_PIN],GPIO.HIGH)
            elif temperature_f | temperature_c >= temperature_f_chaud | temperature_c_chaud :
                GPIO.setup([LED_R_PIN],GPIO.HIGH)
            
            # Wait for a moment before reading again
            time.sleep(2)

    except KeyboardInterrupt:
        print("Program terminated by user.")

else:
    print("DS18B20 Sensor not found.")