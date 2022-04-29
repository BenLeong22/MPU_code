# import pickle
#
# with open("distance.txt", "rb") as fp:   # Unpickling
#     distance = pickle.load(fp)
#
# id =[10, 50, 30, 40]
# row =[]
# matric=[]
#
# for i in id:
#     for j in id:
#         row.append(distance[i][j])
#
#     matric.append(row)
#     row=[]
#
#

from TSP import *
a =[100,80,40,10,30]

a =gettsp(a)

print(a)