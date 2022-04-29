# coding=utf8
import pickle
from datetime import date

import pygad
import numpy
from database import *
from Google import *
import json

from distance import *
import numpy as np
import time
import datetime
from flask import Flask
from datetime import date
from flask import request


from datetime import timedelta


with open("walk_distance_matrix.txt", "rb") as fp:   # Unpickling
    walk_distance_matrix = pickle.load(fp)

with open("walk_duration_matrix.txt", "rb") as fp:   # Unpickling
    walk_duration_matrix = pickle.load(fp)

with open("bus_duration_final.txt", "rb") as fp:   # Unpickling
    bus_duration_final = pickle.load(fp)

gone =[]

test = [(1, '{"en": "康公庙", "pt": "康公庙", "zh-CN": "康公庙", "zh-MO": "康公庙"}', 6.3, 113.377563, 22.50696, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (2, '{"en": "澳门海事博物馆", "pt": "澳门海事博物馆", "zh-CN": "澳门海事博物馆", "zh-MO": "澳门海事博物馆"}', 6.5, 113.530596, 22.18594, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (3, '{"en": "妈阁炮台", "pt": "妈阁炮台", "zh-CN": "妈阁炮台", "zh-MO": "妈阁炮台"}', 4.0, 113.530647, 22.18266, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (4, '{"en": "妈阁庙", "pt": "妈阁庙", "zh-CN": "妈阁庙", "zh-MO": "妈阁庙"}', 9.0, 113.531276, 22.18617, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (5, '{"en": "融和門", "pt": "融和門", "zh-CN": "融和門", "zh-MO": "融和門"}', 6.0, 113.531696, 22.17951, 10, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (6, '{"en": "港务局大楼", "pt": "港务局大楼", "zh-CN": "港务局大楼", "zh-MO": "港务局大楼"}', 8.5, 113.532605, 22.18741, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (7, '{"en": "西望洋花园", "pt": "西望洋花园", "zh-CN": "西望洋花园", "zh-MO": "西望洋花园"}', 7.0, 113.533443, 22.18485, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (8, '{"en": "郑家大屋", "pt": "郑家大屋", "zh-CN": "郑家大屋", "zh-MO": "郑家大屋"}', 8.5, 113.534889, 22.18871, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (9, '{"en": "亚婆井前地", "pt": "亚婆井前地", "zh-CN": "亚婆井前地", "zh-MO": "亚婆井前地"}', 8.7, 113.534996, 22.18839, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (10, '{"en": "主教山小堂", "pt": "主教山小堂", "zh-CN": "主教山小堂", "zh-MO": "主教山小堂"}', 8.6, 113.535152, 22.18679, 40, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (11, '{"en": "十六浦主题公园", "pt": "十六浦主题公园", "zh-CN": "十六浦主题公园", "zh-MO": "十六浦主题公园"}', 8.6, 113.535845, 22.19696, 120, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (12, '{"en": "圣老楞佐教堂", "pt": "圣老楞佐教堂", "zh-CN": "圣老楞佐教堂", "zh-MO": "圣老楞佐教堂"}', 7.2, 113.536765, 22.19062, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (13, '{"en": "圣若瑟修院及圣堂", "pt": "圣若瑟修院及圣堂", "zh-CN": "圣若瑟修院及圣堂", "zh-MO": "圣若瑟修院及圣堂"}', 8.5, 113.537369, 22.19146, 22, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (14, '{"en": "新华大旅店", "pt": "新华大旅店", "zh-CN": "新华大旅店", "zh-MO": "新华大旅店"}', 4.0, 113.537506, 22.19465, 20, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (15, '{"en": "福隆新街", "pt": "福隆新街", "zh-CN": "福隆新街", "zh-MO": "福隆新街"}', 7.5, 113.537618, 22.19446, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (16, '{"en": "何东图书馆大楼", "pt": "何东图书馆大楼", "zh-CN": "何东图书馆大楼", "zh-MO": "何东图书馆大楼"}', 7.2, 113.537724, 22.19242, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (17, '{"en": "澳门旅游塔", "pt": "澳门旅游塔", "zh-CN": "澳门旅游塔", "zh-MO": "澳门旅游塔"}', 7.9, 113.537773, 22.17997, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (18, '{"en": "澳门特别行政区政府总部", "pt": "澳门特别行政区政府总部", "zh-CN": "澳门特别行政区政府总部", "zh-MO": "澳门特别行政区政府总部"}', 7.2, 113.538078, 22.18986, 10, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (19, '{"en": "伯多禄五世剧院", "pt": "伯多禄五世剧院", "zh-CN": "伯多禄五世剧院", "zh-MO": "伯多禄五世剧院"}', 8.5, 113.538113, 22.19192, 20, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (20, '{"en": "圣奥斯定堂", "pt": "圣奥斯定堂", "zh-CN": "圣奥斯定堂", "zh-MO": "圣奥斯定堂"}', 8.9, 113.538389, 22.19225, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (21, '{"en": "烂鬼楼巷", "pt": "烂鬼楼巷", "zh-CN": "烂鬼楼巷", "zh-MO": "烂鬼楼巷"}', 8.1, 113.538826, 22.1971, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (22, '{"en": "新中央酒店", "pt": "新中央酒店", "zh-CN": "新中央酒店", "zh-MO": "新中央酒店"}', 5.6, 113.53909, 22.19421, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (23, '{"en": "三街会馆", "pt": "三街会馆", "zh-CN": "三街会馆", "zh-MO": "三街会馆"}', 7.9, 113.539382, 22.19404, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (24, '{"en": "圣安多尼堂", "pt": "圣安多尼堂", "zh-CN": "圣安多尼堂", "zh-MO": "圣安多尼堂"}', 8.4, 113.539451, 22.19896, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (25, '{"en": "白鸽巢公园", "pt": "白鸽巢公园", "zh-CN": "白鸽巢公园", "zh-MO": "白鸽巢公园"}', 8.3, 113.539489, 22.19982, 45, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (26, '{"en": "澳门市政厅", "pt": "澳门市政厅", "zh-CN": "澳门市政厅", "zh-MO": "澳门市政厅"}', 7.7, 113.539524, 22.19327, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (27, '{"en": "中西药局旧址", "pt": "中西药局旧址", "zh-CN": "中西药局旧址", "zh-MO": "中西药局旧址"}', 7.5, 113.539566, 22.19606, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (28, '{"en": "土地庙", "pt": "土地庙", "zh-CN": "土地庙", "zh-MO": "土地庙"}', 5.6, 113.53968, 22.20194, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (29, '{"en": "议事亭前地", "pt": "议事亭前地", "zh-CN": "议事亭前地", "zh-MO": "议事亭前地"}', 9.0, 113.539759, 22.19353, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (30, '{"en": "马礼逊教堂", "pt": "马礼逊教堂", "zh-CN": "马礼逊教堂", "zh-MO": "马礼逊教堂"}', 7.8, 113.539792, 22.19955, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (31, '{"en": "东方基金会会址", "pt": "东方基金会会址", "zh-CN": "东方基金会会址", "zh-MO": "东方基金会会址"}', 7.7, 113.539814, 22.20035, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (32, '{"en": "永利音乐喷泉", "pt": "永利音乐喷泉", "zh-CN": "永利音乐喷泉", "zh-MO": "永利音乐喷泉"}', 9.0, 113.539878, 22.18777, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (33, '{"en": "俊秀巷", "pt": "俊秀巷", "zh-CN": "俊秀巷", "zh-MO": "俊秀巷"}', 5.0, 113.539961, 22.19689, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (34, '{"en": "仁慈堂博物馆", "pt": "仁慈堂博物馆", "zh-CN": "仁慈堂博物馆", "zh-MO": "仁慈堂博物馆"}', 8.2, 113.540202, 22.19373, 25, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (35, '{"en": "邮政总局大楼", "pt": "邮政总局大楼", "zh-CN": "邮政总局大楼", "zh-MO": "邮政总局大楼"}', 9.0, 113.540232, 22.19331, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (36, '{"en": "女娲庙", "pt": "女娲庙", "zh-CN": "女娲庙", "zh-MO": "女娲庙"}', 7.4, 113.540408, 22.19543, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (37, '{"en": "玫瑰堂", "pt": "玫瑰堂", "zh-CN": "玫瑰堂", "zh-MO": "玫瑰堂"}', 8.5, 113.540408, 22.19472, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (38, '{"en": "大三巴街", "pt": "大三巴街", "zh-CN": "大三巴街", "zh-MO": "大三巴街"}', 8.4, 113.54058, 22.19672, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (39, '{"en": "旧城墙遗址", "pt": "旧城墙遗址", "zh-CN": "旧城墙遗址", "zh-MO": "旧城墙遗址"}', 9.0, 113.540585, 22.19771, 60, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (40, '{"en": "賣草地街", "pt": "賣草地街", "zh-CN": "賣草地街", "zh-MO": "賣草地街"}', 6.7, 113.54062, 22.19544, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (41, '{"en": "大三巴哪吒庙", "pt": "大三巴哪吒庙", "zh-CN": "大三巴哪吒庙", "zh-MO": "大三巴哪吒庙"}', 9.5, 113.540649, 22.19772, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (42, '{"en": "恋爱巷", "pt": "恋爱巷", "zh-CN": "恋爱巷", "zh-MO": "恋爱巷"}', 8.5, 113.540685, 22.19737, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (43, '{"en": "天主教艺术博物馆与墓室", "pt": "天主教艺术博物馆与墓室", "zh-CN": "天主教艺术博物馆与墓室", "zh-MO": "天主教艺术博物馆与墓室"}', 9.7, 113.540711, 22.19793, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (44, '{"en": "友谊雕塑", "pt": "友谊雕塑", "zh-CN": "友谊雕塑", "zh-MO": "友谊雕塑"}', 6.0, 113.540858, 22.19665, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (45, '{"en": "澳门大三巴牌坊", "pt": "澳门大三巴牌坊", "zh-CN": "澳门大三巴牌坊", "zh-MO": "澳门大三巴牌坊"}', 10.0, 113.54086, 22.19767, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (46, '{"en": "卢家大屋", "pt": "卢家大屋", "zh-CN": "卢家大屋", "zh-MO": "卢家大屋"}', 8.0, 113.541232, 22.19421, 55, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (47, '{"en": "板樟堂街", "pt": "板樟堂街", "zh-CN": "板樟堂街", "zh-MO": "板樟堂街"}', 8.5, 113.541372, 22.19452, 60, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (48, '{"en": "圣母圣诞主教座堂", "pt": "圣母圣诞主教座堂", "zh-CN": "圣母圣诞主教座堂", "zh-MO": "圣母圣诞主教座堂"}', 8.4, 113.541477, 22.19361, 56, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (49, '{"en": "澳门主教座堂", "pt": "澳门主教座堂", "zh-CN": "澳门主教座堂", "zh-MO": "澳门主教座堂"}', 7.9, 113.541477, 22.19361, 45, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (50, '{"en": "澳门博物馆", "pt": "澳门博物馆", "zh-CN": "澳门博物馆", "zh-MO": "澳门博物馆"}', 9.7, 113.542156, 22.19716, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (51, '{"en": "大炮台", "pt": "大炮台", "zh-CN": "大炮台", "zh-MO": "大炮台"}', 10.0, 113.542219, 22.19712, 45, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (52, '{"en": "消防博物馆", "pt": "消防博物馆", "zh-CN": "消防博物馆", "zh-MO": "消防博物馆"}', 7.9, 113.543455, 22.20015, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (53, '{"en": "八角亭图书馆", "pt": "八角亭图书馆", "zh-CN": "八角亭图书馆", "zh-MO": "八角亭图书馆"}', 8.0, 113.543797, 22.19269, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (54, '{"en": "疯堂斜巷", "pt": "疯堂斜巷", "zh-CN": "疯堂斜巷", "zh-MO": "疯堂斜巷"}', 7.5, 113.544403, 22.19738, 40, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (55, '{"en": "加思栏炮台", "pt": "加思栏炮台", "zh-CN": "加思栏炮台", "zh-MO": "加思栏炮台"}', 7.1, 113.544569, 22.19156, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (56, '{"en": "婆仔屋", "pt": "婆仔屋", "zh-CN": "婆仔屋", "zh-MO": "婆仔屋"}', 7.8, 113.544601, 22.19747, 60, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (57, '{"en": "艺竹苑", "pt": "艺竹苑", "zh-CN": "艺竹苑", "zh-MO": "艺竹苑"}', 6.0, 113.544614, 22.19754, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (58, '{"en": "新葡京酒店", "pt": "新葡京酒店", "zh-CN": "新葡京酒店", "zh-MO": "新葡京酒店"}', 8.9, 113.544742, 22.18954, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (59, '{"en": "澳门保安部队博物馆", "pt": "澳门保安部队博物馆", "zh-CN": "澳门保安部队博物馆", "zh-MO": "澳门保安部队博物馆"}', 9.5, 113.544799, 22.1916, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (60, '{"en": "望德圣母堂", "pt": "望德圣母堂", "zh-CN": "望德圣母堂", "zh-MO": "望德圣母堂"}', 7.8, 113.545414, 22.19742, 60, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (61, '{"en": "西洋坟场", "pt": "西洋坟场", "zh-CN": "西洋坟场", "zh-MO": "西洋坟场"}', 7.5, 113.545633, 22.19873, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (62, '{"en": "亚卑寮奴你士街", "pt": "亚卑寮奴你士街", "zh-CN": "亚卑寮奴你士街", "zh-MO": "亚卑寮奴你士街"}', 8.0, 113.546139, 22.19689, 20, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (63, '{"en": "牛房仓库", "pt": "牛房仓库", "zh-CN": "牛房仓库", "zh-MO": "牛房仓库"}', 8.1, 113.546418, 22.2074, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (64, '{"en": "澳门中央图书馆", "pt": "澳门中央图书馆", "zh-CN": "澳门中央图书馆", "zh-MO": "澳门中央图书馆"}', 7.5, 113.546822, 22.19846, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (65, '{"en": "永利吉祥树富贵龙", "pt": "永利吉祥树富贵龙", "zh-CN": "永利吉祥树富贵龙", "zh-MO": "永利吉祥树富贵龙"}', 8.9, 113.547275, 22.18928, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (66, '{"en": "永利发财树", "pt": "永利发财树", "zh-CN": "永利发财树", "zh-MO": "永利发财树"}', 8.9, 113.547349, 22.18961, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (67, '{"en": "望厦炮台", "pt": "望厦炮台", "zh-CN": "望厦炮台", "zh-MO": "望厦炮台"}', 6.5, 113.547622, 22.2079, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (68, '{"en": "莲峰庙", "pt": "莲峰庙", "zh-CN": "莲峰庙", "zh-MO": "莲峰庙"}', 7.3, 113.547787, 22.20984, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (69, '{"en": "澳门茶文化馆", "pt": "澳门茶文化馆", "zh-CN": "澳门茶文化馆", "zh-MO": "澳门茶文化馆"}', 7.8, 113.547828, 22.19972, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (70, '{"en": "美高梅水天幕广场", "pt": "美高梅水天幕广场", "zh-CN": "美高梅水天幕广场", "zh-MO": "美高梅水天幕广场"}', 8.6, 113.547884, 22.18548, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (71, '{"en": "美高梅展艺空间", "pt": "美高梅展艺空间", "zh-CN": "美高梅展艺空间", "zh-MO": "美高梅展艺空间"}', 7.5, 113.547884, 22.18548, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (72, '{"en": "乐映天幕", "pt": "乐映天幕", "zh-CN": "乐映天幕", "zh-MO": "乐映天幕"}', 9.0, 113.547927, 22.18564, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (73, '{"en": "望厦圣方济各小堂", "pt": "望厦圣方济各小堂", "zh-CN": "望厦圣方济各小堂", "zh-MO": "望厦圣方济各小堂"}', 7.7, 113.54877, 22.20434, 45, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (74, '{"en": "艺园", "pt": "艺园", "zh-CN": "艺园", "zh-MO": "艺园"}', 7.7, 113.54878, 22.19046, 56, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (75, '{"en": "澳门国父纪念馆", "pt": "澳门国父纪念馆", "zh-CN": "澳门国父纪念馆", "zh-MO": "澳门国父纪念馆"}', 8.6, 113.548915, 22.19989, 54, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (76, '{"en": "东望洋灯塔", "pt": "东望洋灯塔", "zh-CN": "东望洋灯塔", "zh-MO": "东望洋灯塔"}', 8.1, 113.549671, 22.19649, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (77, '{"en": "谭公庙", "pt": "谭公庙", "zh-CN": "谭公庙", "zh-MO": "谭公庙"}', 7.9, 113.550136, 22.11415, 20, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (78, '{"en": "普济禅院", "pt": "普济禅院", "zh-CN": "普济禅院", "zh-MO": "普济禅院"}', 8.1, 113.550278, 22.20444, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (79, '{"en": "三圣宫", "pt": "三圣宫", "zh-CN": "三圣宫", "zh-MO": "三圣宫"}', 7.0, 113.550969, 22.11896, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (80, '{"en": "路环图书馆", "pt": "路环图书馆", "zh-CN": "路环图书馆", "zh-MO": "路环图书馆"}', 7.1, 113.551053, 22.11662, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (81, '{"en": "四面佛", "pt": "四面佛", "zh-CN": "四面佛", "zh-MO": "四面佛"}', 8.7, 113.551238, 22.15718, 40, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (82, '{"en": "路环圣方济各圣堂", "pt": "路环圣方济各圣堂", "zh-CN": "路环圣方济各圣堂", "zh-MO": "路环圣方济各圣堂"}', 8.5, 113.551481, 22.11689, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (83, '{"en": "百老汇", "pt": "百老汇", "zh-CN": "百老汇", "zh-MO": "百老汇"}', 8.0, 113.551585, 22.14675, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (84, '{"en": "觀音像", "pt": "觀音像", "zh-CN": "觀音像", "zh-MO": "觀音像"}', 9.0, 113.552101, 22.1858, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (85, '{"en": "基本法纪念馆", "pt": "基本法纪念馆", "zh-CN": "基本法纪念馆", "zh-MO": "基本法纪念馆"}', 6.8, 113.552378, 22.19542, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (86, '{"en": "大赛车博物馆", "pt": "大赛车博物馆", "zh-CN": "大赛车博物馆", "zh-MO": "大赛车博物馆"}', 8.8, 113.552916, 22.19494, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (87, '{"en": "葡萄酒博物馆", "pt": "葡萄酒博物馆", "zh-CN": "葡萄酒博物馆", "zh-MO": "葡萄酒博物馆"}', 9.0, 113.552916, 22.19494, 60, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (88, '{"en": "金莲花广场", "pt": "金莲花广场", "zh-CN": "金莲花广场", "zh-MO": "金莲花广场"}', 7.8, 113.55332, 22.19437, 40, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (89, '{"en": "澳门银河", "pt": "澳门银河", "zh-CN": "澳门银河", "zh-MO": "澳门银河"}', 8.6, 113.55336, 22.15008, 110, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (90, '{"en": "澳门回归贺礼陈列馆", "pt": "澳门回归贺礼陈列馆", "zh-CN": "澳门回归贺礼陈列馆", "zh-MO": "澳门回归贺礼陈列馆"}', 8.5, 113.554072, 22.18992, 30, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (91, '{"en": "澳门艺术博物馆", "pt": "澳门艺术博物馆", "zh-CN": "澳门艺术博物馆", "zh-MO": "澳门艺术博物馆"}', 8.2, 113.55459, 22.18872, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (92, '{"en": "金沙娱乐场", "pt": "金沙娱乐场", "zh-CN": "金沙娱乐场", "zh-MO": "金沙娱乐场"}', 7.0, 113.554871, 22.19163, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (93, '{"en": "澳门通讯博物馆", "pt": "澳门通讯博物馆", "zh-CN": "澳门通讯博物馆", "zh-MO": "澳门通讯博物馆"}', 8.0, 113.554972, 22.20325, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (94, '{"en": "澳門文化中心", "pt": "澳門文化中心", "zh-CN": "澳門文化中心", "zh-MO": "澳門文化中心"}', 8.4, 113.5552, 22.1891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (95, '{"en": "玛利二世皇后眺望台", "pt": "玛利二世皇后眺望台", "zh-CN": "玛利二世皇后眺望台", "zh-MO": "玛利二世皇后眺望台"}', 8.1, 113.555439, 22.20341, 40, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (96, '{"en": "路氹历史馆", "pt": "路氹历史馆", "zh-CN": "路氹历史馆", "zh-MO": "路氹历史馆"}', 7.9, 113.555717, 22.15243, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (97, '{"en": "澳门渔人码头", "pt": "澳门渔人码头", "zh-CN": "澳门渔人码头", "zh-MO": "澳门渔人码头"}', 7.9, 113.556276, 22.19271, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (98, '{"en": "土地暨自然博物馆", "pt": "土地暨自然博物馆", "zh-CN": "土地暨自然博物馆", "zh-MO": "土地暨自然博物馆"}', 7.9, 113.556577, 22.12582, 60, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (99, '{"en": "澳门科学馆", "pt": "澳门科学馆", "zh-CN": "澳门科学馆", "zh-MO": "澳门科学馆"}', 8.6, 113.556842, 22.18606, 120, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (100, '{"en": "澳门大熊猫馆", "pt": "澳门大熊猫馆", "zh-CN": "澳门大熊猫馆", "zh-MO": "澳门大熊猫馆"}', 7.7, 113.558979, 22.12663, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (101, '{"en": "龙环葡韵住宅式博物馆", "pt": "龙环葡韵住宅式博物馆", "zh-CN": "龙环葡韵住宅式博物馆", "zh-MO": "龙环葡韵住宅式博物馆"}', 8.4, 113.559618, 22.15383, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (102, '{"en": "威尼斯人贡多拉体验", "pt": "威尼斯人贡多拉体验", "zh-CN": "威尼斯人贡多拉体验", "zh-MO": "威尼斯人贡多拉体验"}', 8.2, 113.559839, 22.14703, 120, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (103, '{"en": "新濠影汇", "pt": "新濠影汇", "zh-CN": "新濠影汇", "zh-MO": "新濠影汇"}', 8.6, 113.561368, 22.141, 100, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (104, '{"en": "巴黎人埃菲尔铁塔", "pt": "巴黎人埃菲尔铁塔", "zh-CN": "巴黎人埃菲尔铁塔", "zh-MO": "巴黎人埃菲尔铁塔"}', 7.7, 113.562293, 22.1436, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (105, '{"en": "媽祖文化村", "pt": "媽祖文化村", "zh-CN": "媽祖文化村", "zh-MO": "媽祖文化村"}', 8.3, 113.563271, 22.12268, 60, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (106, '{"en": "妈祖像", "pt": "妈祖像", "zh-CN": "妈祖像", "zh-MO": "妈祖像"}', 8.2, 113.564058, 22.12373, 100, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (107, '{"en": "美狮美高梅Janice Wong", "pt": "美狮美高梅Janice Wong", "zh-CN": "美狮美高梅Janice Wong", "zh-MO": "美狮美高梅Janice Wong"}', 8.6, 113.568103, 22.14553, 120, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (108, '{"en": "永利皇宫", "pt": "永利皇宫", "zh-CN": "永利皇宫", "zh-MO": "永利皇宫"}', 9.6, 113.571202, 22.14755, 60, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (109, '{"en": "黑沙水库郊野公园", "pt": "黑沙水库郊野公园", "zh-CN": "黑沙水库郊野公园", "zh-MO": "黑沙水库郊野公园"}', 7.8, 113.571205, 22.12422, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (110, '{"en": "黑沙海滩", "pt": "黑沙海滩", "zh-CN": "黑沙海滩", "zh-MO": "黑沙海滩"}', 5.0, 113.571288, 22.12175, 120, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (111, '{"en": "九澳水库郊野公园", "pt": "九澳水库郊野公园", "zh-CN": "九澳水库郊野公园", "zh-MO": "九澳水库郊野公园"}', 5.0, 113.577893, 22.13377, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (112, '{"en": "九澳村", "pt": "九澳村", "zh-CN": "九澳村", "zh-MO": "九澳村"}', 5.6, 113.582282, 22.13313, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (113, '{"en": "九澳七苦圣母小堂", "pt": "九澳七苦圣母小堂", "zh-CN": "九澳七苦圣母小堂", "zh-MO": "九澳七苦圣母小堂"}', 6.0, 113.589241, 22.13247, 50, 0, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (114, '{"en": "天后庙", "pt": "天后庙", "zh-CN": "天后庙", "zh-MO": "天后庙"}', 5.0, 114.199479, 22.28782, 30, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (115, '{"en": "北帝庙", "pt": "北帝庙", "zh-CN": "北帝庙", "zh-MO": "北帝庙"}', 7.8, 114.208663, 22.21703, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (116, '{"en": "竹林寺", "pt": "竹林寺", "zh-CN": "竹林寺", "zh-MO": "竹林寺"}', 7.0, 121.389343, 25.08364, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (117, '{"en": "巨型财神雕像", "pt": "巨型财神雕像", "zh-CN": "巨型财神雕像", "zh-MO": "巨型财神雕像"}', 8.0, 0.0, 0.0, 50, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (118, '{"en": "金光大道度假区体验梦工场", "pt": "金光大道度假区体验梦工场", "zh-CN": "金光大道度假区体验梦工场", "zh-MO": "金光大道度假区体验梦工场"}', 7.0, 0.0, 0.0, 120, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 1, '[0]'), (247, '{"en": "“西游记”舞台演出", "pt": "“西游记”舞台演出", "zh-CN": "“西游记”舞台演出", "zh-MO": "“西游记”舞台演出"}', 8.0, 113.5651, 22.14661, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (248, '{"en": "新濠影滙“魔幻间”表演", "pt": "新濠影滙“魔幻间”表演", "zh-CN": "新濠影滙“魔幻间”表演", "zh-MO": "新濠影滙“魔幻间”表演"}', 9.9, 113.5624, 22.14083, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (249, '{"en": "表演湖喷泉演出", "pt": "表演湖喷泉演出", "zh-CN": "表演湖喷泉演出", "zh-MO": "表演湖喷泉演出"}', 8.2, 113.5454, 22.18833, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (250, '{"en": "影汇之星摩天轮", "pt": "影汇之星摩天轮", "zh-CN": "影汇之星摩天轮", "zh-MO": "影汇之星摩天轮"}', 9.8, 113.5619, 22.14088, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (251, '{"en": "派驰夜店 Pacha", "pt": "派驰夜店 Pacha", "zh-CN": "派驰夜店 Pacha", "zh-MO": "派驰夜店 Pacha"}', 8.8, 113.5619, 22.14088, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (252, '{"en": "蝙蝠侠夜神飞驰4D电影", "pt": "蝙蝠侠夜神飞驰4D电影", "zh-CN": "蝙蝠侠夜神飞驰4D电影", "zh-MO": "蝙蝠侠夜神飞驰4D电影"}', 8.6, 113.5619, 22.14088, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (253, '{"en": "华纳满Fun童乐园", "pt": "华纳满Fun童乐园", "zh-CN": "华纳满Fun童乐园", "zh-MO": "华纳满Fun童乐园"}', 7.6, 113.5619, 22.14088, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (254, '{"en": "澳门百老汇舞台", "pt": "澳门百老汇舞台", "zh-CN": "澳门百老汇舞台", "zh-MO": "澳门百老汇舞台"}', 8.7, 113.5522, 22.14661, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (255, '{"en": "威尼斯人娱乐场", "pt": "威尼斯人娱乐场", "zh-CN": "威尼斯人娱乐场", "zh-MO": "威尼斯人娱乐场"}', 9.6, 113.562, 22.14713, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (256, '{"en": "新濠天地娱乐城", "pt": "新濠天地娱乐城", "zh-CN": "新濠天地娱乐城", "zh-MO": "新濠天地娱乐城"}', 10.0, 113.5669, 22.1484, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (257, '{"en": "金沙娱乐场", "pt": "金沙娱乐场", "zh-CN": "金沙娱乐场", "zh-MO": "金沙娱乐场"}', 9.4, 113.5551, 22.19113, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (258, '{"en": "澳门赛马会", "pt": "澳门赛马会", "zh-CN": "澳门赛马会", "zh-MO": "澳门赛马会"}', 9.2, 113.5481, 22.15688, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (259, '{"en": "澳门兰桂坊与宋玉生广场", "pt": "澳门兰桂坊与宋玉生广场", "zh-CN": "澳门兰桂坊与宋玉生广场", "zh-MO": "澳门兰桂坊与宋玉生广场"}', 7.9, 113.5506, 22.19002, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (260, '{"en": "UA银河影城", "pt": "UA银河影城", "zh-CN": "UA银河影城", "zh-MO": "UA银河影城"}', 7.3, 113.5551, 22.14844, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (261, '{"en": "红伶私人会所", "pt": "红伶私人会所", "zh-CN": "红伶私人会所", "zh-MO": "红伶私人会所"}', 8.9, 113.5524, 22.15009, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (262, '{"en": "银河天浪淘园", "pt": "银河天浪淘园", "zh-CN": "银河天浪淘园", "zh-MO": "银河天浪淘园"}', 9.3, 113.5533, 22.14958, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 3, '[0]'), (263, '{"en": "钜记（官也街店）", "pt": "钜记（官也街店）", "zh-CN": "钜记（官也街店）", "zh-MO": "钜记（官也街店）"}', 7.9, 113.5564915, 22.15400231, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (264, '{"en": "咀香园饼家（大三巴店）", "pt": "咀香园饼家（大三巴店）", "zh-CN": "咀香园饼家（大三巴店）", "zh-MO": "咀香园饼家（大三巴店）"}', 7.6, 113.5406858, 22.19688891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (265, '{"en": "晃记饼家", "pt": "晃记饼家", "zh-CN": "晃记饼家", "zh-MO": "晃记饼家"}', 7.3, 113.5568915, 22.15340231, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (266, '{"en": "老佛爷西饼店", "pt": "老佛爷西饼店", "zh-CN": "老佛爷西饼店", "zh-MO": "老佛爷西饼店"}', 7.3, 113.5401558, 22.19119891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (267, '{"en": "幸运阁电脑商场", "pt": "幸运阁电脑商场", "zh-CN": "幸运阁电脑商场", "zh-MO": "幸运阁电脑商场"}', 6.1, 113.5476283, 22.20453546, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (268, '{"en": "香记肉干（官也街店）", "pt": "香记肉干（官也街店）", "zh-CN": "香记肉干（官也街店）", "zh-MO": "香记肉干（官也街店）"}', 7.6, 113.5569115, 22.15368231, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (269, '{"en": "最香饼家", "pt": "最香饼家", "zh-CN": "最香饼家", "zh-MO": "最香饼家"}', 7.2, 113.5370488, 22.19373672, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (270, '{"en": "威尼斯人大运河购物中心", "pt": "威尼斯人大运河购物中心", "zh-CN": "威尼斯人大运河购物中心", "zh-MO": "威尼斯人大运河购物中心"}', 10.0, 113.5614346, 22.14756114, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (271, '{"en": "烂鬼楼巷", "pt": "烂鬼楼巷", "zh-CN": "烂鬼楼巷", "zh-MO": "烂鬼楼巷"}', 6.2, 113.5387037, 22.19699547, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (272, '{"en": "边度有书 · 独立书店", "pt": "边度有书 · 独立书店", "zh-CN": "边度有书 · 独立书店", "zh-MO": "边度有书 · 独立书店"}', 7.7, 113.5399558, 22.19386891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (273, '{"en": "英记饼家（大三巴店）", "pt": "英记饼家（大三巴店）", "zh-CN": "英记饼家（大三巴店）", "zh-MO": "英记饼家（大三巴店）"}', 7.8, 113.5409158, 22.19725891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (274, '{"en": "红街市大楼", "pt": "红街市大楼", "zh-CN": "红街市大楼", "zh-MO": "红街市大楼"}', 7.0, 113.5447483, 22.20544546, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (275, '{"en": "三盏灯街区", "pt": "三盏灯街区", "zh-CN": "三盏灯街区", "zh-MO": "三盏灯街区"}', 6.9, 113.5461836, 22.20272214, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (276, '{"en": "水坑尾街", "pt": "水坑尾街", "zh-CN": "水坑尾街", "zh-MO": "水坑尾街"}', 6.2, 113.5434088, 22.19395391, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (277, '{"en": "杏和堂药铺", "pt": "杏和堂药铺", "zh-CN": "杏和堂药铺", "zh-MO": "杏和堂药铺"}', 5.8, 113.5385388, 22.19403672, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (278, '{"en": "永利名店街", "pt": "永利名店街", "zh-CN": "永利名店街", "zh-MO": "永利名店街"}', 9.1, 113.5461958, 22.18892891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (279, '{"en": "四季名店购物中心", "pt": "四季名店购物中心", "zh-CN": "四季名店购物中心", "zh-MO": "四季名店购物中心"}', 9.0, 113.5622196, 22.14557114, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (280, '{"en": "金沙城中心购物广场", "pt": "金沙城中心购物广场", "zh-CN": "金沙城中心购物广场", "zh-MO": "金沙城中心购物广场"}', 8.4, 113.5645496, 22.14562114, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (281, '{"en": "新濠大道购物中心", "pt": "新濠大道购物中心", "zh-CN": "新濠大道购物中心", "zh-MO": "新濠大道购物中心"}', 9.4, 113.5668673, 22.1484033, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (282, '{"en": "巴黎人购物中心", "pt": "巴黎人购物中心", "zh-CN": "巴黎人购物中心", "zh-MO": "巴黎人购物中心"}', 9.9, 113.5631696, 22.14352114, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (283, '{"en": "信达城购物中心", "pt": "信达城购物中心", "zh-CN": "信达城购物中心", "zh-MO": "信达城购物中心"}', 6.8, 113.5424458, 22.19440891, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (284, '{"en": "老牌车厘哥夫", "pt": "老牌车厘哥夫", "zh-CN": "老牌车厘哥夫", "zh-MO": "老牌车厘哥夫"}', 7.5, 113.5571615, 22.15299231, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (285, '{"en": "新濠影汇购物大道", "pt": "新濠影汇购物大道", "zh-CN": "新濠影汇购物大道", "zh-MO": "新濠影汇购物大道"}', 9.3, 113.5618862, 22.14082925, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (286, '{"en": "澳门银河购物中心", "pt": "澳门银河购物中心", "zh-CN": "澳门银河购物中心", "zh-MO": "澳门银河购物中心"}', 9.8, 113.5540138, 22.14641015, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]'), (287, '{"en": "美高梅购物长廊", "pt": "美高梅购物长廊", "zh-CN": "美高梅购物长廊", "zh-MO": "美高梅购物长廊"}', 8.9, 113.5483703, 22.18594911, 40, 1, 0, 0, datetime.timedelta(seconds=28800), datetime.timedelta(seconds=54000), 4, '[0]')]

sql ="SELECT places.id,places.name,place_details.score,places.longitude,places.latitude,place_details.rec_time,place_details.in_door,place_details.budget,place_details.budget,place_details.from_time,place_details.to_time,place_has_categories.category_id,place_details.disable_week_days FROM places INNER JOIN place_details ON places.id=place_details.id INNER JOIN place_has_categories ON place_has_categories.place_id=place_details.id"
allspot =getdatabasedata(sql)
allspot.insert(0,0)

# day =3
# user_input_start =9
# user_input_end =15
# user_input_budget = 10000
# user_input_had_breakfast =0
# user_input_had_lunch =0
# user_input_had_dinner =0
# user_input_hotel =-1
# user_input_hotel_level = 5


rang_list =[]
shorest_distance =100000


for a in test:
    rang_list.append(a[0])
app = Flask(__name__)
@app.route("/query")
def home():
    if request.args.get('day') is None:
        day = 1
    else:
        day = int(request.args.get('day'))

    if request.args.get('user_input_start') is None:
        user_input_start = 9
    else:
        user_input_start = int(request.args.get('user_input_start'))

    if request.args.get('user_input_end') is None:
        user_input_end = 15
    else:
        user_input_end = request.args.get('user_input_end')

    if request.args.get('user_input_budget') is None:
        user_input_budget = 1000
    else:
        user_input_budget = request.args.get('user_input_budget')

    if request.args.get('user_input_had_breakfast') is None:
        user_input_had_breakfast = 0
    else:
        user_input_had_breakfast = int(request.args.get('user_input_had_breakfast'))

    if request.args.get('user_input_had_lunch') is None:
        user_input_had_lunch = 0
    else:
        user_input_had_lunch = int(request.args.get('user_input_had_lunch'))

    if request.args.get('user_input_had_dinner') is None:
        user_input_had_dinner = 0
    else:
        user_input_had_dinner = int(request.args.get('user_input_had_dinner'))

    if request.args.get('user_input_hotel') is None:
        user_input_hotel = -1
    else:
        user_input_hotel = int(request.args.get('user_input_hotel'))

    if request.args.get('user_input_hotel_level') is None:
        user_input_hotel_level = 5
    else:
        user_input_hotel_level = int(request.args.get('user_input_hotel_level'))


    # print(day)




    dt = date.today()
    t = datetime.time(int(user_input_start), 00)
    combined = datetime.datetime.combine(dt, t)

    dt = date.today()
    endtime = datetime.time(int(user_input_end), 00)
    endtime = datetime.datetime.combine(dt, endtime)

    def set_hotel():
        if user_input_hotel== -1:
            hotelsql = "SELECT places.id,places.name,place_details.score,places.longitude,places.latitude,place_details.rec_time,place_details.in_door,place_details.budget,place_details.budget,place_details.from_time,place_details.to_time,place_has_categories.category_id,place_details.disable_week_days FROM places INNER JOIN place_details ON places.id=place_details.id INNER JOIN place_has_categories ON place_has_categories.place_id=place_details.id WHERE place_has_categories.category_id = 2 AND place_details.score=" + str(user_input_hotel_level) + " ORDER BY RAND () LIMIT 1"
            hoteldata = getdatabasedata(hotelsql)
            return hoteldata[0][0]
        else:
            hotelsql = "SELECT places.id,places.name,place_details.score,places.longitude,places.latitude,place_details.rec_time,place_details.in_door,place_details.budget,place_details.budget,place_details.from_time,place_details.to_time,place_has_categories.category_id,place_details.disable_week_days FROM places INNER JOIN place_details ON places.id=place_details.id INNER JOIN place_has_categories ON place_has_categories.place_id=place_details.id WHERE place_details.id="+str(user_input_hotel)+"  ORDER BY RAND () LIMIT 1"
            hoteldata = getdatabasedata(hotelsql)
            return hoteldata[0][0]

    def get_hotel_list():
        sql ='SELECT places.id,places.name,place_details.score,places.longitude,places.latitude,place_details.rec_time,place_details.in_door,place_details.budget,place_details.budget,place_details.from_time,place_details.to_time,place_has_categories.category_id,place_details.disable_week_days FROM places INNER JOIN place_details ON places.id=place_details.id INNER JOIN place_has_categories ON place_has_categories.place_id=place_details.id WHERE place_has_categories.category_id =2'
        data = getdatabasedata(sql)
        hotel =[]
        for a in data:
            hotel.append(a[0])
        return hotel


    hotel_idx =set_hotel()
    hotel_list = get_hotel_list()
    # print(hotel_idx)



    def getweather():
        with open('weatherdata.txt') as json_file:
            data = json.load(json_file)
        c = 0
        weather_arr = []
        while (c < len(data)):
            weather_arr.append(data[c].get("main"))

            c += 1

        return weather_arr

    weatherdata =getweather()

    def checkIfDuplicates(listOfElems):
        duplicatesall =[x for x in listOfElems if x in gone]

        sum =0
        if len(listOfElems) == len(set(listOfElems)) and not duplicatesall:
            sum =0
        else:
            sum = -1000000000

        return sum

    def selfscore(x):
        sum =0
        c =0
        # print(x)
        while c < len(x):
            idx =x[c]
            # print(test[idx][2])
            if allspot[idx][2] is None:
                score=0
            else:
                score =allspot[idx][2]
            sum +=score



            c = c + 1
            if allspot[idx][6] ==0:
                if weatherdata[day] == "Rain" or weatherdata[day] == "Thunderstorm" or weatherdata[day] == "Snow":
                    sum -= 10

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
                distance = walk_distance_matrix[idx][next]
                all_distance +=distance


                if distance <500:
                    score =8
                elif distance>=500 and distance<1000:
                    score =6

                elif distance>=1000 and distance<1500:
                    score =4

                elif distance>=1500 and distance<2000:
                    score =2

                else:
                    score =0



            c =c+1

            sum += score
        # print(shorest_distance)
        if all_distance <= shorest_distance:
            sum += 200
            shorest_distance =all_distance

        return sum

    def isopentime(item,daytime):

        x = daytime
        weekday = x.weekday()
        x = datetime.timedelta(hours=x.hour, minutes=x.minute, seconds=x.second, microseconds=x.microsecond)
        # print(x)
        # print("asdfasdf")
        start = datetime.timedelta(seconds=0)
        end = start = datetime.timedelta(seconds=0)
        thatday = datetime.datetime(dt.year, dt.month, dt.day)


        if item[9] is None:
            start = thatday + datetime.timedelta(seconds=0)
        else:
            start = thatday+item[9]


        if item[10] is None:

            end = thatday + datetime.timedelta(seconds=86400)
        else:
            end = thatday + item[10]


        disable_week_days = item[12]

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
        #     print("yes")
        # print(daytime)
        # print(start)
        # print((daytime - start).seconds)
        # print("hihihi")

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

    def isfittime(solution):
        x =solution
        daytime = combined
        sum =0
        c =0

        user_end = daytime.today()
        t = datetime.time(int(user_input_end), 00)
        user_end_time = datetime.datetime.combine(dt, t)

        had_breakfast = 0
        had_lunch = 0
        had_dinner = 0
        # print(solution)
        while c < len(x):
            idx =x[c]
            sum +=isopentime(allspot[idx],daytime)
            # print(isopentime(allspot[idx],daytime))
            # print("sum here")
            # if daytime.hour==9 and had_breakfast==0:
            #     if allspot[idx][11] ==5:
            #         sum +=50
            #         had_breakfast=1
            #
            # if daytime.hour==13 and had_lunch==0:
            #     if allspot[idx][11] ==5:
            #         sum +=50
            #         had_lunch = 1
            #
            # if daytime.hour==18 and had_dinner==0:
            #     if allspot[idx][11] ==5:
            #         sum +=50
            #         had_dinner = 1

            daytime += datetime.timedelta(minutes = allspot[idx][5])
            # print(daytime)
            if c >= 0 and c < len(x) - 1:
                idx = x[c]
                next = x[c + 1]
                daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)
                # print(str(bus_duration_final[idx][next] // 60)+"min")
            c = c + 1
            # print(daytime)
            # print(user_end_time)


        return sum

    def print_result(solution):
        x = solution
        daytime = combined
        sum = 0
        c = 0

        while c < len(x):
            idx = x[c]
            daytime += datetime.timedelta(minutes=allspot[idx][5])

            if c >= 0 and c < len(x) - 1:
                idx = x[c]
                next = x[c + 1]
                daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)
            c = c + 1
        # print(daytime)
        return daytime

    def find_nearest_restaurant(lon,lat):

        sql ='SELECT id,name, ( 3959 * acos( cos( RADIANS('+str(lat)+') ) * cos( radians( places.latitude ) ) * cos( radians( places.longitude ) - radians('+str(lon)+') ) + sin( radians('+str(lat)+') ) * sin( radians( places.latitude ) ) ) ) AS distance from places INNER JOIN place_has_categories ON place_has_categories.place_id=places.id WHERE place_has_categories.category_id=5 having  distance <= 25 order by distance'
        restaurant = getdatabasedata(sql)
        return restaurant[0][0]



    def set_restaurant(solution,real_time,goal_endtime):
        x = solution
        t = datetime.time(int(user_input_end), 00)
        user_end_time = datetime.datetime.combine(dt, t)
        c =0
        had_breakfast =user_input_had_breakfast
        # print(had_breakfast)
        # print("user break")
        had_lunch = user_input_had_lunch
        had_dinner = user_input_had_dinner
        daytime = combined

        while c < len(x):
            idx = x[c]
            # print(daytime.hour)
            # print("here")
            if (daytime.hour ==9 and had_breakfast ==0 and (idx not in hotel_list)):
                restarurant = find_nearest_restaurant(allspot[idx][3],allspot[idx][4])
                # print("breakfast yes")
                had_breakfast = 1
                idx = restarurant
                x[c] = idx

            if (daytime.hour ==13 and had_lunch ==0 and (idx not in hotel_list)):
                restarurant = find_nearest_restaurant(allspot[idx][3],allspot[idx][4])
                had_lunch = 1
                # print("lunch yes")
                idx = restarurant
                x[c] = idx



            daytime += datetime.timedelta(minutes=allspot[idx][5])

            if c >= 0 and c < len(x) - 1:
                idx = x[c]
                next = x[c + 1]
                daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)


            c = c + 1

        return x,daytime




    def re_soft(solution,real_time,goal_endtime):
        # print("start resort")
        # print(solution)
        x = solution
        sum = 0
        c = 0
        daytime=combined
        # print(goal_endtime)
        # print(real_time)
        # print("real_time")
        id =solution
        start_time=[]
        end_time =[]
        traffic_time =[]
        if real_time>goal_endtime:
            # print("here 1")

            avg_time = (real_time - goal_endtime)
            avg_time = avg_time.total_seconds()/60
            avg_time = avg_time/(len(solution)-2)
            avg_time = (avg_time)
            avg_time= (round(avg_time))
            while c < len(x):
                idx = x[c]
                # print(allspot[idx][1])
                # print(str(daytime) + "start time")
                start_time.append(str(daytime))
                if c==0 or c==len(x)-1:
                     print()
                else:
                    daytime += datetime.timedelta(minutes=allspot[idx][5] - avg_time)

                # print(str(daytime) + "end time")
                end_time.append(str(daytime))
                if c >= 0 and c < len(x) - 1:
                    idx = x[c]
                    next = x[c + 1]
                    daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)
                    traffic_time.append((bus_duration_final[idx][next] // 60))
                c = c + 1
        else:

            avg_time = (goal_endtime - real_time)
            avg_time = avg_time.total_seconds()/60
            avg_time = avg_time/(len(solution)-2)
            avg_time = (avg_time)
            # print(avg_time)
            avg_time= (round(avg_time))
            while c < len(x):

                idx = x[c]
                # print(allspot[idx][1])
                # print(str(daytime) + "start time")
                start_time.append(str(daytime))
                if c==0 or c==len(x)-1:
                     print()
                else:
                    daytime += datetime.timedelta(minutes=allspot[idx][5] + avg_time)

                # print(str(daytime) + "end time")
                end_time.append(str(daytime))
                if c >= 0 and c < len(x)-1 :
                    idx = x[c]
                    next = x[c + 1]
                    daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)
                    traffic_time.append(bus_duration_final[idx][next] // 60)
                c = c + 1

        return id,start_time,end_time,traffic_time

    def cut_solution(solution):
        x = solution
        daytime = combined
        sum = 0
        c = 0
        new_sulution=[]

        while c < len(x):
            if daytime <= endtime:
                new_sulution.append(x[c])
                idx = x[c]
                daytime += datetime.timedelta(minutes=allspot[idx][5])

                if c >= 0 and c < len(x) - 1:
                    idx = x[c]
                    next = x[c + 1]
                    daytime += datetime.timedelta(minutes=bus_duration_final[idx][next] // 60)
            c = c + 1
        # print(daytime)
        return new_sulution


    def fitness_func(solution, solution_idx):

        checkduplicate =checkIfDuplicates(solution)
        if checkduplicate ==-1000000000:
            return -100000000

        solution = np.insert(solution,0,hotel_idx, axis=None)
        # solution =TSP(solution)
        solution =np.append(solution,hotel_idx,axis = None)

        # print(solution)
        # hotelid =gethotelidx()
        # solution = np.insert(solution,0,hotelid, axis=None)
        # solution =np.append(solution,hotelid,axis = None)
        # print(solution)

        sumofself = selfscore(solution) #done
        sumofbet = betweenscore(solution) #done
        checktime = isfittime(solution)




        fitness =sumofself + sumofbet + checktime

        return fitness


    data =[]
    for a in range(day):

        ga_instance = pygad.GA(num_generations=1000,
                                   num_parents_mating=10,
                                   fitness_func=fitness_func,
                                   gene_type=int,
                                   sol_per_pop=20,
                                   allow_duplicate_genes=False,
                                   # init_range_low=0,
                                   # init_range_high=len(test),
                                   gene_space=rang_list,
                                   mutation_type='random',
                                   crossover_type='scattered',
                                   # num_genes=(user_input_end-user_input_start)*2,
                                   num_genes=10,
                                   save_best_solutions=True,
                                   # on_crossover=on_crossover,
                                   # num_genes=len(X),
                                   suppress_warnings=True)

        ga_instance.run()

                    # fig = ga_instance.plot_result()

        solution, solution_fitness, _ = ga_instance.best_solution()
        print("Parameters of the best solution:\n{solution}".format(solution=solution), end="\n\n")
        print("Fitness value of the best solution:\n{solution_fitness}".format(solution_fitness=solution_fitness), end="\n\n")



        prediction = numpy.sum(solution)
        print("Predicted output based on the best solution:\n{prediction}".format(prediction=prediction), end="\n\n")



        if ga_instance.best_solution_generation != -1:
            print("Best fitness value reached after {best_solution_generation} generations.".format(best_solution_generation=ga_instance.best_solution_generation))

        solution = np.insert(solution,0,hotel_idx, axis=None)

        solution= cut_solution(solution)
        # print(solution)

        solution =np.append(solution,hotel_idx,axis = None)

        daytime =print_result(solution)

        add_restaurant = set_restaurant(solution,daytime,endtime)
        print(add_restaurant[0])
        jsondata = re_soft(add_restaurant[0],add_restaurant[1],endtime)

        combined= combined+ datetime.timedelta(days=1)
        endtime= endtime+ datetime.timedelta(days=1)
        for b in solution:
            gone.append(b)
        # print("here")
        # print(jsondata[1])
        x = {"Day":a+1,
            "Data":[
            {
            "Id": jsondata[0].tolist(),
            "Start_time": jsondata[1],
            "End_time": jsondata[2],
            "Traffic_time": jsondata[3]
            }
        ]
        }
        # print(x)
        data.append(x)





    # print(data)
    data = app.response_class(response=json.dumps(data),
                                  status=200,
                                  mimetype='application/json')

    return data

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=8888, debug=True)