
<?php 
$attraction_data ='[{"placeId": 175, "Name": "Museum of the Macao Security Forces", "lattitude": 22.191604, "longitude": 113.544799, "start": "2018-07-22 09:00:00", "end": "2018-07-22 09:33:00", "traffic_time": 1}, {"placeId": 135, "Name": "Lou Kau Mansion", "lattitude": 22.1942136, "longitude": 113.5412315, "start": "2018-07-22 09:34:21.800000", "end": "2018-07-22 09:50:21.800000", "traffic_time": 2}, {"placeId": 132, "Name": "Sam Kai Vui Kun (Kuan Tai Temple)", "lattitude": 22.1940388, "longitude": 113.5393824, "start": "2018-07-22 09:53:17.500000", "end": "2018-07-22 10:22:17.500000", "traffic_time": 2}, {"placeId": 15, "Name": "Vasco da Gama Garden", "lattitude": 22.1961949, "longitude": 113.5465303, "start": "2018-07-22 10:24:30.600000", "end": "2018-07-22 10:49:30.600000", "traffic_time": 4}, {"placeId": 114, "Name": "Wetland in Alto de Coloane", "lattitude": 22.2121713, "longitude": 113.5566389, "start": "2018-07-22 10:54:01.400000", "end": "2018-07-22 11:23:01.400000", "traffic_time": 17}, {"placeId": 26, "Name": "Hac S? Park", "lattitude": 22.1178969, "longitude": 113.568988, "start": "2018-07-22 11:40:37.100000", "end": "2018-07-22 12:15:37.100000", "traffic_time": 16}, {"placeId": 108, "Name": "Leisure Area in Pra?a de Jorge ?lvares", "lattitude": 22.1910159, "longitude": 113.5398722, "start": "2018-07-22 12:32:02.500000", "end": "2018-07-22 13:03:02.500000", "traffic_time": 1}, {"placeId": 166, "Name": "Museum of the Holy House of Mercy", "lattitude": 22.193734, "longitude": 113.540202, "start": "2018-07-22 13:04:26.400000", "end": "2018-07-22 13:34:26.400000", "traffic_time": 5}, {"placeId": 172, "Name": "The Patane Night Watch House", "lattitude": 22.2020261, "longitude": 113.539582, "start": "2018-07-22 13:39:34.900000", "end": "2018-07-22 13:54:34.900000", "traffic_time": 4}, {"placeId": 9, "Name": "Marginal da Areia Preta Park", "lattitude": 22.209374, "longitude": 113.5559237, "start": "2018-07-22 13:59:05.700000", "end": "2018-07-22 14:24:05.700000", "traffic_time": 3}, {"placeId": 182, "Name": "Jao Tsung-I Academy", "lattitude": 22.19892689, "longitude": 113.5471605, "start": "2018-07-22 14:27:13.500000", "end": "2018-07-22 14:48:13.500000", "traffic_time": 16}, {"placeId": 51, "Name": "Coloane Seac Min Pun Ancient Path", "lattitude": 22.1172208, "longitude": 113.5666217, "start": "2018-07-22 15:05:01.800000", "end": "2018-07-22 15:21:01.800000", "traffic_time": 0}]';
    
$data = json_decode($attraction_data); 
$length = count($data);

$placeId =[];
$name =[];
$lattitude =[];
$longitude =[];
$start =[];
$end =[];
$traffic_time =[];

for ($i = 0;$i< $length;$i++){
    array_push($placeId, $data[$i] -> placeId);
    array_push($name, $data[$i] -> Name);
    array_push($lattitude, $data[$i] -> lattitude);
    array_push($longitude, $data[$i] -> longitude);
    array_push($start, $data[$i] -> start);
    array_push($end, $data[$i] -> end);
    array_push($traffic_time, $data[$i] -> traffic_time);
}

foreach($placeId as $value){
    echo $value . "<br>";
}

foreach($name as $value){
    echo $value . "<br>";
}

?>