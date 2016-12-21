#!/usr/bin/env python
# -*- coding: utf-8 -*-
import smbus
import time


# Define some constants from the datasheet

DEVICE     = 0x23 # Default device I2C address

POWER_DOWN = 0x00 # No active state
POWER_ON   = 0x01 # Power on
RESET      = 0x07 # Reset data register value

# Start measurement at 4lx resolution. Time typically 16ms.
CONTINUOUS_LOW_RES_MODE = 0x13
# Start measurement at 1lx resolution. Time typically 120ms
CONTINUOUS_HIGH_RES_MODE_1 = 0x10
# Start measurement at 0.5lx resolution. Time typically 120ms
CONTINUOUS_HIGH_RES_MODE_2 = 0x11
# Start measurement at 1lx resolution. Time typically 120ms
# Device is automatically set to Power Down after measurement.
ONE_TIME_HIGH_RES_MODE_1 = 0x20
# Start measurement at 0.5lx resolution. Time typically 120ms
# Device is automatically set to Power Down after measurement.
ONE_TIME_HIGH_RES_MODE_2 = 0x21
# Start measurement at 1lx resolution. Time typically 120ms
# Device is automatically set to Power Down after measurement.
ONE_TIME_LOW_RES_MODE = 0x23

#bus = smbus.SMBus(0) # Rev 1 Pi uses 0
bus = smbus.SMBus(1)  # Rev 2 Pi uses 1

def convertToNumber(data):
  # Simple function to convert 2 bytes of data
  # into a decimal number
    return ((data[1] + (256 * data[0])) / 1.2)

def readLight(addr=DEVICE):
    data = bus.read_i2c_block_data(addr,ONE_TIME_HIGH_RES_MODE_1)
    return convertToNumber(data)



def getPH():
    import serial

    usbport = '/dev/ttyAMA0'
    ser = serial.Serial(usbport, 9600)

    #turn on the LEDs
    ser.write("L,1\r")
    ser.write("C,1\r")

    line = ""
    result = ""
    x = 0
    count = 0
    try:
        while True:
            data = ser.read()
            if(data == "*"):
                x = x+1
            if(data == "\r"):
                if(x > 0):
                    line = ""
                    x = 0
                else:
                    print "Received from sensor: " + line
                    result = line #get result to write to database
                    line = ""
                    count = count+1
            else:
                line = line + data
            if(count > 0):
                break;

    except KeyboardInterrupt:
        print "\n---Stop Receving PH data---"
        ser.close()

    #write result to database
    return result


import os
import datetime
import glob
import MySQLdb
from time import strftime

os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')

base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'

water_folder = glob.glob(base_dir + '28*')[1]
water_file = water_folder + '/w1_slave'


# Variables for MySQL
#db = MySQLdb.connect(host="localhost", user="root",passwd="raspberry", db="sensorDB")
#cur = db.cursor()

def tempRead():
    t = open(device_file, 'r')
    lines = t.readlines()
    t.close()

    temp_output = lines[1].find('t=')
    if temp_output != -1:
        temp_string = lines[1].strip()[temp_output+2:]
        temp_c = float(temp_string)/1000.0
    return round(temp_c,1)

def waterRead():
    t = open(water_file, 'r')
    lines = t.readlines()
    t.close()

    temp_output = lines[1].find('t=')
    if temp_output != -1:
        temp_string = lines[1].strip()[temp_output+2:]
        temp_c = float(temp_string)/1000.0
    return round(temp_c,1)

def uploadData(tt,temp,pH,light,water):
    import requests
    r = requests.post("http://aquaponics-ncnu.herokuapp.com/insertData", data={'datetime':tt,'temp':temp,'pH':pH,'light':light,'user_id':1,'water':water})
    print(r.status_code, r.reason)
    r.encoding = 'utf-8-sig'
    print(r.text)

def getWarning():
    import  json
    import requests
    r = requests.get("http://aquaponics-ncnu.herokuapp.com/getWarn",params={"id":"1"})
    r.encoding = 'utf-8-sig'
    d = json.loads(r.text)
    return d

def isNormal(jsonData,temp,ph):
    normal = True
    msg = ""
    if warn['temp_max']<temp or warn['temp_min']>temp :
        msg += "系統水溫異常，目前水溫："+str(temp)+"度\n"
        normal = False
    if warn['pH_max']<ph or warn['pH_min']>ph :
        msg += "系統pH值異常，目前pH值："+str(ph)+"\n"
        normal = False
    if normal == False :
        sendWarningMsg(msg)

    
def sendWarningMsg(msg):
    import  json
    import requests
    data = {"type":"note","title":"警告","body":msg,"channel_tag":"Aquaponics"}
    r = requests.post("https://api.pushbullet.com/v2/pushes",headers={"Access-Token":"o.AKLf4ibtUTTPk5jdMQSgwywzDnBSTjQr"},data=data)
    r.encoding = 'utf-8-sig'
    print(r.encoding)
    print(r.text)

while True:
    warn = getWarning()
    temp = tempRead()
    light = readLight()
    water = waterRead()
    ph = getPH()
    print temp
    datetimeWrite = (time.strftime("%Y-%m-%d ") + time.strftime("%H:%M:%S"))
    print datetimeWrite
    print("water: %f, temp: %f" % (water, temp))
    # uploadData
    uploadData(datetimeWrite,temp,ph,light,water)
    isNormal(warn,temp,ph)
        
    break
  

