import json
import pickle
import time
import pygad as pygad
import numpy
from database import *
from flask import request
from flask import Flask
import datetime
from datetime import datetime
from datetime import timedelta

trip_start ='2022-02-06'
def getweather():
    with open('weatherdata.txt') as json_file:
        data = json.load(json_file)

    c =0
    weathertime = data["time"]
    describe =data["describe"]

    for value in weathertime:

        if value == trip_start:
            describe =describe[c]
        c += 1

    return describe


weatherdata = getweather()

print(weatherdata)