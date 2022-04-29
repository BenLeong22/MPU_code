# coding=utf8
import mysql.connector
import requests
import json

import urllib
import urllib.request

import json

mydb = mysql.connector.connect(
    host="127.0.0.1",
    # host="165.232.172.30",
    port='8110',
    user="root",
    password="",
    database="fyp",
    auth_plugin='mysql_native_password'
    )


def getdatabasedata(sql):
    attractions = mydb.cursor()
    attractions.execute(sql)
    attractionsdata = attractions.fetchall()
    attractions.close()
    return attractionsdata

def osmr(origin_longitude,origin_latitude,destination_longitude,destination_latitude):

    # call the OSMR API
    temsasd ="http://localhost:5000/route/v1/foot/"+str(origin_longitude)+","+str(origin_latitude)+";"+str(destination_longitude)+","+str(destination_latitude)+"?overview=false"
    # print(temsasd)
    print(temsasd)
    r = requests.get(f"http://localhost:5000/route/v1/foot/"+str(origin_longitude)+","+str(origin_latitude)+";"+str(destination_longitude)+","+str(destination_latitude)+"?overview=false")

    results = json.loads(r.content)
    print(results)
    a = 10000
    if(results.get("code") == "Ok"):
        legs = results.get("routes").pop(0).get("legs")
        a = legs[0].get("distance")
    print(a)
    return a


def google(origin_longitude,origin_latitude,destination_longitude,destination_latitude):

    gmaps = googlemaps.Client(key='AIzaSyDvdsmNd9c2sH89xA0LSrLw5DL4GJ1eka0')

    my_dist = gmaps.distance_matrix([str(origin_latitude) + " " + str(origin_longitude)],
                                    [str(destination_latitude) + " " + str(destination_longitude)], mode='transit')
    print(my_dist)
    check = my_dist.get("rows")[0].get("elements")[0].get("status")
    print(check)
    a = 100000
    print(my_dist)
    if check == 'OK':
        a = my_dist.get("rows")[0].get("elements")[0].get("duration").get("value")

        print(a)

    return a


def output(myresult):
    result =[]
    print(myresult)
    for x in myresult:
        row = []
        for y in myresult:
            my_dist = osmr(float(x[3]), float(x[4]), float(y[3]), float(y[4]))
            row.append(int(my_dist))
            # gmaps = googlemaps.Client(key='AIzaSyCvJTbnzdh7y_Fy9iPuwSa3HagvcfBbSpw')
            #
            # my_dist = gmaps.distance_matrix([str(x[4]) + " " + str(x[3])],
            #                                 [str(y[4]) + " " + str(y[3])])['rows'][0][
            #      'elements'][0]['distance']['value']

        result.append(row)

    return result


