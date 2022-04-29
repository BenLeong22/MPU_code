from database import *
import json

import pickle
import time

allsql ="SELECT attractions.A_id,attractions.A_name,attractions.A_latitude,attractions.A_logitude,attractions.A_category,attractions_details.AD_score,attractions_details.AD_Child_budget,attractions_details.AD_Adult_budget,attractions_details.AD_from_time,attractions_details.AD_to_time,attractions_details.AD_recommend_time FROM attractions INNER JOIN attractions_details on attractions.A_id=attractions_details.A_id"
allspot =getdatabasedata(allsql)

sql ="SELECT attractions.A_id,attractions.A_name,attractions.A_latitude,attractions.A_logitude,attractions.A_category,attractions_details.AD_score,attractions_details.AD_Child_budget,attractions_details.AD_Adult_budget,attractions_details.AD_from_time,attractions_details.AD_to_time,attractions_details.AD_recommend_time FROM attractions INNER JOIN attractions_details on attractions.A_id=attractions_details.A_id WHERE attractions_details.A_id>1"
spot =getdatabasedata(sql)



len(spot)
print(spot)

with open("distance.txt", "rb") as fp:   # Unpickling
    x = pickle.load(fp)


row = []
all =[]

renamex =0

count =0
for c in spot:
    for d in allspot:
        print(count)
        # if count >51000:
        #     break
        print(c[0])
        print(d[0])
        count = count+1
        print(c[3],c[4],d[3],d[4])

        x[c[0]][d[0]] = osmr(c[3], c[2], d[3], d[2])

        with open("distance_final.txt", "wb") as fp:
            pickle.dump(x, fp)


