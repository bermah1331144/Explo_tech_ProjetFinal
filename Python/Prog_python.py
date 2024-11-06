#!/usr/bin/env python3
import ressources.PCF8591 as ADC
import ressources.rgb_led as LED
import RPi.GPIO as GPIO
import time
import math
import mysql.connector
from mysql.connector import Error

myBd = mysql.connector.connect(
	host='localhost',
	user='maheb',
	password= 'Rouge1',
	datebase='BDallumToi' 
)

moncursor = myBd.cursor()

DO = 11
GPIO.setmode(GPIO.BOARD)


tempefroid = 18
tempeTiede = 20
tempeChaud = 30
R = 29
G = 31
B = 33

# >< 
def setup():
	ADC.setup(0x48)
	GPIO.setup(DO, GPIO.IN)

def Print(x):
	if x == 1:
		print ('')
		print ('***********')
		print ('* Better~ *')
		print ('***********')
		print ('')
	if x == 0:
		print ('')
		print ('************')
		print ('* Too Hot! *')
		print ('************')
		print ('')
		
def GetTempe(temp) :
		if temp <= tempefroid :
			LED.setColor(0x0000FF)
		if temp > tempefroid and temp < tempeChaud :
			LED.setColor(0x00FF00)
		if temp > tempeChaud :
		    LED.setColor(0xFF0000)

def ReturnTempe(temp) :
	temperature = print ('temperature = ', temp, 'C')	
	return temperature

def loop():
	status = 1
	tmp = 1
	while True:
		analogVal = ADC.read(0)
		Vr = 5 * float(analogVal) / 255
		Rt = 10000 * Vr / (5 - Vr)
		temp = 1/(((math.log(Rt / 10000)) / 3950) + (1 / (273.15+25)))
		temp = temp - 273.15
		print ('temperature = ', temp, 'C')	
		GetTempe(temp)
		ReturnTempe(temp)
 
		# For a threshold, uncomment one of the code for
		# which module you use. DONOT UNCOMMENT BOTH!
		#################################################
		# 1. For Analog Temperature module(with DO)
		tmp = GPIO.input(DO)
		# 
		# 2. For Thermister module(with sig pin)
		#if temp > 33:
		#	tmp = 0
		#elif temp < 31:
		#	tmp = 1
		#################################################

    
		if tmp != status:
			Print(tmp)
			status = tmp

		time.sleep(1)
	


if __name__ == '__main__':
	try:
		LED.setup(R,G,B)
		
		setup()
		loop()
		GetTempe()
	except KeyboardInterrupt: 
		pass	



while True:
	temperature = ReturnTempe(temperature)
	sql = "INSERT INTO temperature(temperature,time_tempe) VALUES(temperature,NOW()) "