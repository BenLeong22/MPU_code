from database import *
import json

import pickle



sql ="SELECT attractions.A_id,attractions.A_name,attractions.A_latitude,attractions.A_logitude,attractions.A_category,attractions_details.AD_score,attractions_details.AD_Child_budget,attractions_details.AD_Adult_budget,attractions_details.AD_from_time,attractions_details.AD_to_time,attractions_details.AD_recommend_time FROM attractions INNER JOIN attractions_details on attractions.A_id=attractions_details.A_id"
spot =getdatabasedata(sql)



len(spot)
print(spot)

x =[]
x = [[None for _ in range(len(spot)+1)] for _ in range(len(spot)+1)]
row = []
all =[]
renamex =0
while renamex < len(spot):
    x[0][renamex+1] = spot[renamex][1]
    renamey =0
    while renamey < len(spot):
        x[renamey+1][0] = spot[renamey][1]
        renamey =renamey+1
    renamex =renamex+1
print(x)

for c in spot:
    for d in spot:
        print(c[0])
        print(d[0])
        print(c[0])
        print(d[0])
        x[c[0]][d[0]] =osmr(c[3],c[2],d[3],d[2])
        with open("distance.txt", "wb") as fp:
            pickle.dump(x, fp)

with open("distance.txt", "wb") as fp:
    pickle.dump(x, fp)