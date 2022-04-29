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
from TSP import *


with open("duration.txt", "rb") as fp:   # Unpickling
    duration = pickle.load(fp)

with open("distance.txt", "rb") as fp:   # Unpickling
    walk_distance = pickle.load(fp)

shorest_distance = 100000



sql ="SELECT attractions.A_id,attractions.A_name,attractions.A_latitude,attractions.A_logitude,attractions.A_category,attractions_details.AD_score,attractions_details.AD_Child_budget,attractions_details.AD_Adult_budget,attractions_details.AD_from_time,attractions_details.AD_to_time,attractions_details.AD_recommend_time,attractions_details.AD_disable_week_days,attractions_details.AD_in_door FROM attractions INNER JOIN attractions_details on attractions.A_id=attractions_details.A_id"
attractiondata =getdatabasedata(sql)
type(attractiondata) #list format

attractiondata.insert(0,'0')

app = Flask(__name__)


@app.route("/query")
def home():


    if request.args.get('trip_start') is None:
        trip_start = datetime.today().strftime('%Y-%m-%d')
    else:
        trip_start = request.args.get('trip_start')

    if request.args.get('user_input_start') is None:
        user_input_start = "9:00"
    else:
        user_input_start = request.args.get('user_input_start')


    if request.args.get('user_input_end') is None:
        user_input_end = "15:00"
    else:
        user_input_end = request.args.get('user_input_end')

    if request.args.get('user_input_budget') is None:
        user_input_budget = 500
    else:
        user_input_budget = request.args.get('user_input_budget')

    if request.args.get('user_input_child') is None:
        user_input_child = 1
    else:
        user_input_child = request.args.get('user_input_child')

    if request.args.get('user_input_adult') is None:
        user_input_adult = 1
    else:
        user_input_adult = request.args.get('user_input_adult')

    def getweather():
        with open('weatherdata.txt') as json_file:
            data = json.load(json_file)
        c = 0
        weathertime = data["time"]
        describe = data["describe"]
        # print(describe)
        weather =[]
        for value in weathertime:
            if value == trip_start:
                describe = describe[c]
            c += 1
        weather.append(describe)
        return weather

    weatherdata = getweather()

    trip_start = datetime.strptime(trip_start, "%Y-%m-%d").date()
    user_input_start = datetime.strptime(user_input_start, '%H:%M').time()

    user_input_end = datetime.strptime(user_input_end, '%H:%M').time()

    combined = datetime.combine(trip_start, user_input_start)

    user_input_end = datetime.combine(trip_start, user_input_end)
    # print(type(combined))

  # //  print(user_input_end)



    def fitness_func(solution, solution_idx):

        self_score = selfscore(solution)
        distance_score =betweenscore(solution)
        time_score = fittime(solution)
        budget_score =overbudget(solution)

        # fitness = self_score+distance_score+time_score+budget_score
        fitness =distance_score

        print("Gen:"+str(solution))

        return fitness


    def selfscore(solution):
        sum =0
        for id in solution:
            sum +=attractiondata[id][5]

            if attractiondata[id][12] ==0:
                if weatherdata[0] == "Rain" or weatherdata[0] == "Thunderstorm" or weatherdata[0] == "Snow" or weatherdata[0] == "light rain":
                    sum -= 300




        return sum



    def isopen(id,daytime):

        weekday=daytime.weekday()



        endtime= id[9] - timedelta(seconds=1)
        thatday = datetime.strptime(str(daytime.date()), "%Y-%m-%d").date()
        start = datetime.strptime(str(id[8]), '%H:%M:%S').time()
        end = datetime.strptime(str(endtime), '%H:%M:%S').time()
        start = datetime.combine(trip_start, start)
        end =datetime.combine(trip_start, end)


        disable_week_days = id[11]

        if "0" in disable_week_days and weekday ==0:
            notbussinesstime =1
        elif "1" in disable_week_days and weekday ==1:
            notbussinesstime = 1
        elif "2" in disable_week_days and weekday ==2:
            notbussinesstime = 1
        elif "3" in disable_week_days and weekday ==3:
            notbussinesstime = 1
        elif "4" in disable_week_days and weekday == 4:
            notbussinesstime = 1
        elif "5" in disable_week_days and weekday ==5:
            notbussinesstime = 1
        elif "6" in disable_week_days and weekday ==6:
            notbussinesstime = 1
        else:
            notbussinesstime = 0

        minus_start_time = (daytime - start).seconds
        minus_start_time = (daytime - end).seconds
        if (start <= daytime <=end):
            return 10
        elif (minus_start_time<150) and daytime <=end  and notbussinesstime==0:
            return 9
        elif (minus_start_time<300)  and daytime <=end and notbussinesstime==0:
            return 8
        elif (minus_start_time<600)  and daytime <=end and notbussinesstime==0:
            return 7
        elif (minus_start_time<1800)  and daytime <=end and notbussinesstime==0:
            return 6
        elif (minus_start_time<3600)  and daytime <=end and notbussinesstime==0:
            return 5
        else:
            return 0


        return 0

    def overbudget(solution):
        sum = 0
        c = 0
        over = 0

        while c < len(solution):
            idx = solution[c]

            sum += int(attractiondata[idx][6]) * int(user_input_child)
            sum += int(attractiondata[idx][7]) * int(user_input_adult)
            c = c + 1


        if sum > int(user_input_budget):
            over = -1000000
        else:
            over =0

        return over

    def fittime(solution):
        c=0
        sum = 0
        daytime = combined

        while c < len(solution):

            idx = solution[c]
            sum += isopen(attractiondata[idx], daytime)
            #    print(type(daytime))
            #     print(daytime)

            #     print(timedelta(minutes=attractiondata[idx][10]))
            daytime =daytime + timedelta(minutes=attractiondata[idx][10])

            if c >=1:
                pre_idx =solution[c-1]
                duration_time = duration[pre_idx][idx] //60

                daytime += timedelta(minutes=duration_time)

            c = c + 1


        return sum


    def betweenscore(x):
        sum = 0
        c = 0
        score =0
        distance =0
        all_distance =0
        global shorest_distance

        while c < len(x):
            if c >=0 and c <len(x)-1:
                idx = x[c]
                next =x[c+1]
                distance = walk_distance[idx][next]

                all_distance +=distance
                if distance <300:
                    score =20
                elif distance>=300 and distance<600:
                    score =15
                elif distance>=600 and distance<1000:
                    score =10
                elif distance>=1000 and distance<2000:
                    score =5
                else:
                    score =0


            c =c+1
            sum += score
        # if all_distance <= shorest_distance:
        #     sum += 200
        #     shorest_distance =all_distance

        return sum

    def outputjson(solution):
        c = 0
        sum = 0
        daytime = combined
        start_time =[]
        end_time=[]
        travel_time=[]
        idx_list = []
        while c < len(solution):

            idx = solution[c]
            idx_list.append(idx)
            sum += isopen(attractiondata[idx], daytime)
            start_time.append(daytime)
            daytime += timedelta(minutes=attractiondata[idx][10])
            end_time.append(daytime)
            if c >= 0 and c<len(solution)-1:
                next_idx = solution[c + 1]
                duration_time = duration[idx][next_idx] // 60
                travel_time.append(int(duration_time))
                daytime += timedelta(minutes=duration_time)

            c = c + 1

        x = {
            # "ID":str(idx_list),
            "ID": str(idx_list),
            "start_time": str(start_time),
            "end_time": str(end_time),
            "travel_time": str(travel_time)

        }
        return x

    def print_result(solution):
        x = solution
        daytime = combined
        sum = 0
        c = 0

        while c < len(x):
            idx = x[c]
            #    print(attractiondata[idx][10])
            daytime += timedelta(minutes=attractiondata[idx][10])

            if c >= 0 and c < len(x) - 1:
                idx = x[c]
                next = x[c + 1]
                daytime += timedelta(minutes=duration[idx][next] // 60)
            c = c + 1
        # print(daytime)
        return daytime

    def cut_solution(solution):
        x = solution
        daytime = combined
        sum = 0
        c = 0
        new_sulution=[]

        while c < len(x):
            if daytime <= user_input_end:
                new_sulution.append(x[c])
                idx = x[c]
                daytime += timedelta(minutes=attractiondata[idx][10])

                if c > 0 and c < len(x) - 1:
                    idx = x[c]
                    next = x[c + 1]
                    daytime += timedelta(minutes=duration[idx][next] // 60)
            c = c + 1
        # print(daytime)

        return new_sulution,daytime

    def re_soft(solution,real_time,goal_endtime):
        # print("start resort")
        # print(solution)
        # print(real_time)
        # print(goal_endtime)
        daytime=combined
        # print(daytime)
        id =[]
        start_time=[]
        end_time =[]
        traffic_time =[]
        c=0

        while c < len(solution):

            idx = solution[c]
            id.append(idx)
            start_time.append(str(daytime))

            daytime += timedelta(minutes=attractiondata[idx][10])

            end_time.append(str(daytime))

            if c < len(solution)-1:
                idx= solution[c]
                next=solution[c+1]
                daytime += timedelta(seconds=duration[idx][next])
                traffic_time.append((duration[idx][next] / 60))

            c =c+1



        return [id,start_time,end_time,traffic_time]


    ga_instance = pygad.GA(num_generations=500,
                               num_parents_mating=5,
                               fitness_func=fitness_func,
                               gene_type=int,
                               sol_per_pop=20,
                               allow_duplicate_genes=False,
                               gene_space={'low': 1,'high': len(attractiondata)},
                               mutation_type='random',
                               crossover_type='scattered',
                               # num_genes=(user_input_end-user_input_start)*2,
                               num_genes=20,
                               save_best_solutions=True,
                               # on_crossover=on_crossover,
                               # num_genes=len(X),
                               suppress_warnings=True)

    ga_instance.run()

                # fig = ga_instance.plot_result()

    solution, solution_fitness, _ = ga_instance.best_solution()
    print("Parameters of the best solution:\n{solution}".format(solution=solution), end="\n\n")
    print("Score fitness value of the best solution:\n{solution_fitness}".format(solution_fitness=solution_fitness), end="\n\n")



    prediction = numpy.sum(solution)
    print("Predicted output based on the best solution:\n{prediction}".format(prediction=prediction), end="\n\n")



    if ga_instance.best_solution_generation != -1:
        print("Best fitness value reached after {best_solution_generation} generations.".format(best_solution_generation=ga_instance.best_solution_generation))
    #  print(solution)

    solution =gettsp(solution)
    solution = cut_solution(solution)
    jsondata =re_soft(solution[0],solution[1],user_input_end)
    # print(jsondata)

    jsondata[3].append("0")
    # print(jsondata[3])

    count = 0
    day_data = []
    while count < len(jsondata[0]):

        id = jsondata[0][count]

        day_data.append({
            'placeId': int(id),
            'Name': str(attractiondata[id][1]),
            'lattitude': float(attractiondata[id][2]),
            'longitude': float(attractiondata[id][3]),
            'start': str(jsondata[1][count]),
            'end': str(jsondata[2][count]),
            # "image_rul": attractiondata[id][13],
            'traffic_time': int(jsondata[3][count]),
            'trip_start':str(trip_start),
            'audlt':int(user_input_adult),
            'child': int(user_input_child),
            'budget': int(user_input_budget),
        }
        )
        #    print("yes")
        count = count + 1
    # att_data.append(
    #     {"day": a + 1,
    #      "planPlaceData": day_data
    #
    #      }
    # )

    data = app.response_class(response=json.dumps(day_data, ensure_ascii=False),
                              status=200,
                              mimetype='application/json')

    return data

if __name__ == '__main__':
    # run() method of Flask class runs the application
    # on the local development server.
    app.run(host="0.0.0.0", port=10000, debug=False,threaded=True)