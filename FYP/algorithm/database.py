# coding=utf8
import mysql.connector



mydb = mysql.connector.connect(
    host="127.0.0.1",
    # host="165.232.172.30",
    port="8110",
    user="root",
    database="fyp",
    auth_plugin='mysql_native_password'
    )



def getdatabasedata(sql):
    attractions = mydb.cursor()
    attractions.execute(sql)
    attractionsdata = attractions.fetchall()
    attractions.close()
    return attractionsdata




