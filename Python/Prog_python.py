#!/usr/bin/env python3
import ressources.PCF8591 as ADC
import ressources.rgb_led as LED
import RPi.GPIO as GPIO
import time
import math
import mysql.connector
from mysql.connector import Error
from datetime import datetime


DO = 11
GPIO.setmode(GPIO.BOARD)


tempeFroid = 18
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
		if temp <= tempeFroid :
			LED.setColor(0x0000FF)
		if temp > tempeFroid and temp < tempeChaud :
			LED.setColor(0x00FF00)
		if temp > tempeChaud :
		    LED.setColor(0xFF0000)


def initialiseBD() :
		myBd = mysql.connector.connect(
		host='localhost',
		user='root',
		password= 'cegep123',
		database='BDallumeToi' 
	)
		return myBd


 #J'ai reussi a recuperer le datetime, mais je narrive pas a la mettre dans la bd. a trouver
def insert(tempe,myBd) :

	maintenant = datetime.now()
	print (maintenant)
	monCursor = myBd.cursor()
	insert_temperature =f"INSERT INTO temperature (temperature,time_tempe,tempeFroid,tempeChaud,tiede) VALUES ({tempe},time_tempe,{tempeFroid},{tempeChaud},{tempeTiede})"
	monCursor.execute(insert_temperature)
	myBd.commit()
	print("Données insérées avec succès")
	monCursor.close()

#sert a recuperer les donnees de la temperature pour par la suite l'inejcter ds la BD
def loop():
	status = 1
	tmp = 1
	myBd = initialiseBD()
	while True:
		analogVal = ADC.read(0)
		Vr = 5 * float(analogVal) / 255
		Rt = 10000 * Vr / (5 - Vr)
		temp = 1/(((math.log(Rt / 10000)) / 3950) + (1 / (273.15+25)))
		temp = temp - 273.15


		#impression temp
		print ('temperature = ', temp, 'C')	

		#changer couleur de la LED
		GetTempe(temp)

		#insert la temp dans la bd
		insert(temp,myBd)
 
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

		time.sleep(10)
	myBd.close()
	


if __name__ == '__main__':
	try:
		LED.setup(R,G,B)
		
		setup()
		loop()
	except KeyboardInterrupt: 
		pass	




