import requests
import json
from datetime import datetime

r = requests.get(f"https://api.openweathermap.org/data/2.5/onecall?lat=22.200279&lon=113.546944&exclude=current,minutely,hourly,alerts&appid=10e5e6cb98ce9dc4ef9bb697a267db9e&units=metric")
# then you load the response using the json libray
# by default you get only one alternative so you access 0-th element of the `routes`
results = json.loads(r.content)

a = results.get("daily")
c=0
data = {}
data["time"]=[]
data["image"] = []
data["describe"] = []
data["weather"] = []
data["tem"] = []
data["uvi"] = []
data["wind"] = []
data["humidity"] = []
data["sunrise"] = []
data["sunset"] = []
data["cloud"] = []

while c<len(a):
    day =a[c].get("dt")
    ts = int(day)
    day = datetime.utcfromtimestamp(ts).strftime('%Y-%m-%d')
    image = a[c].get("weather")[0].get("icon")
    describe = a[c].get("weather")[0].get("description")
    weather = a[c].get("temp").get("day")

    uvi = a[c].get("uvi")
    wind =a[c].get("wind_speed")
    humidity =a[c].get("humidity")
    sunrise = a[c].get("sunrise")

    sunrise =a[c].get("moonrise")
    sunrise = int(sunrise)
    sunrise = datetime.utcfromtimestamp(sunrise).strftime('%H:%M:%S')

    sunset =a[c].get("moonset")
    sunset = int(sunset)
    sunset = datetime.utcfromtimestamp(sunset).strftime('%H:%M:%S')

    cloud =a[c].get("clouds")


    data["time"].append(day)
    data["image"].append(image)
    data["describe"].append(describe)
    data["weather"].append(weather)
    data["uvi"].append(uvi)
    data["wind"].append(wind)
    data["humidity"].append(humidity)
    data["sunrise"].append(sunrise)
    data["sunset"].append(sunset)
    data["cloud"].append(cloud)
    c=c+1

with open('weatherdata.txt', 'w') as outfile:
    json.dump(data, outfile)

print(data)
