import requests
from bs4 import BeautifulSoup
from lxml import etree
import csv
import xlsxwriter

all_att=[]

link=[
'https://www.trip.com/travel-guide/attraction/macau/macau-tower-skyjump-34375560/'	,
'https://www.trip.com/travel-guide/attraction/macau/igreja-de-nossa-senhora-do-carmo-76067/'	,
'https://www.trip.com/travel-guide/attraction/macau/sam-kai-vui-kun-temple-76049/'	,
'https://www.trip.com/travel-guide/attraction/macau/rua-de-s-paulo-street-10644498/'	,
'https://www.trip.com/travel-guide/attraction/macau/venetian-theatre-28637850/'	,
'https://www.trip.com/travel-guide/attraction/macau/chapel-of-our-lady-guia-76056/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-tea-culture-house-13293699/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-cultural-centre-20905939/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-museum-of-souvenir-24648579/'	,
'https://www.trip.com/travel-guide/attraction/macau/future-bright-amusement-park-22847449/'	,
'https://www.trip.com/travel-guide/attraction/macau/garden-of-flower-city-10534960/'	,
'https://www.trip.com/travel-guide/attraction/macau/tap-seac-square-22847602/'	,
'https://www.trip.com/travel-guide/attraction/macau/avenida-da-amizade-22847442/'	,
'https://www.trip.com/travel-guide/attraction/macau/guia-hill-cable-car-38333620/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-venetian-macao-84889/'	,
'https://www.trip.com/travel-guide/attraction/macau/travessa-da-paixao-23865287/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-eiffel-tower-30464880/'	,
'https://www.trip.com/travel-guide/attraction/macau/rua-cinco-de-outubro-13364211/'	,
'https://www.trip.com/travel-guide/attraction/macau/space-museum-of-macau-24648580/'	,
'https://www.trip.com/travel-guide/attraction/macau/wudi-temple-38949255/'	,
'https://www.trip.com/travel-guide/attraction/macau/jardim-do-sao-francisco-22847605/'	,
'https://www.trip.com/travel-guide/attraction/macau/st-michaels-chapel-and-cemetery-22847448/'	,
'https://www.trip.com/travel-guide/attraction/macau/tianzhujiao-art-museum-38332842/'	,
'https://www.trip.com/travel-guide/attraction/macau/tin-hau-temple-22847441/'	,
'https://www.trip.com/travel-guide/attraction/macau/zhuhai-ocean-ecology-museum-50614002/'	,
'https://www.trip.com/travel-guide/attraction/macau/avenida-horta-e-costa-58310078/'	,
'https://www.trip.com/travel-guide/attraction/macau/rua-da-cunha-94434/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-fisherman-s-wharf-81974/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-grand-prix-24601359/'	,
'https://www.trip.com/travel-guide/attraction/macau/macao-convention-29890908/'	,
'https://www.trip.com/travel-guide/attraction/macau/sound-of-the-century-the-museum-of-vintage-sound-machines-20905955/'	,
'https://www.trip.com/travel-guide/attraction/macau/studio-city-macau-23058059/'	,
'https://www.trip.com/travel-guide/attraction/macau/igreja-de-santo-agostinho-76063/'	,
'https://www.trip.com/travel-guide/attraction/macau/guia-marco-91564/'	,
'https://www.trip.com/travel-guide/attraction/macau/coloane-kun-iam-temple-84755/'	,
'https://www.trip.com/travel-guide/attraction/macau/cotai-strip-resorts-22847428/'	,
'https://www.trip.com/travel-guide/attraction/macau/treasure-of-sacred-art-museum-20905951/'	,
'https://www.trip.com/travel-guide/attraction/macau/sai-van-lake-24653716/'	,
'https://www.trip.com/travel-guide/attraction/macau/hac-sa-reservoir-country-park-24650259/'	,
'https://www.trip.com/travel-guide/attraction/macau/avenida-da-republic-24651709/'	,
'https://www.trip.com/travel-guide/attraction/macau/mgm-macau-10572519/'	,
'https://www.trip.com/travel-guide/attraction/macau/flora-garden-76042/'	,
'https://www.trip.com/travel-guide/attraction/macau/jardim-da-montanha-russa-76044/'	,
'https://www.trip.com/travel-guide/attraction/macau/kun-iam-statue-13293732/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-giant-panda-pavilion-24648576/'	,
'https://www.trip.com/travel-guide/attraction/macau/avenida-de-almeida-ribeiro-20905954/'	,
'https://www.trip.com/travel-guide/attraction/macau/lin-kai-temple-76051/'	,
'https://www.trip.com/travel-guide/attraction/macau/communications-museum-13293675/'	,
'https://www.trip.com/travel-guide/attraction/macau/chapel-of-st-james-76057/'	,
'https://www.trip.com/travel-guide/attraction/macau/bajiaoting-library-22847437/'	,
'https://www.trip.com/travel-guide/attraction/macau/pou-tai-un-temple-76053/'	,
'https://www.trip.com/travel-guide/attraction/macau/sands-macao-58190117/'	,
'https://www.trip.com/travel-guide/attraction/macau/milky-way-hotel-diamond-hall-39445483/'	,
'https://www.trip.com/travel-guide/attraction/macau/bronze-statue-of-goddess-guanyin-38334154/'	,
'https://www.trip.com/travel-guide/attraction/macau/povoacao-de-ka-ho-50594917/'	,
'https://www.trip.com/travel-guide/attraction/macau/portas-do-cerco-10559039/'	,
'https://www.trip.com/travel-guide/attraction/macau/small-taipa-2000-circuit-82333584/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-museum-82223/'	,
'https://www.trip.com/travel-guide/attraction/macau/st-dominic-s-church-76061/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-parisian-56814166/'	,
'https://www.trip.com/travel-guide/attraction/macau/four-faced-buddha-10534957/'	,
'https://www.trip.com/travel-guide/attraction/macau/rua-dos-ervanarios-50529245/'	,
'https://www.trip.com/travel-guide/attraction/macau/sight-56809969/'	,
'https://www.trip.com/travel-guide/attraction/macau/sight-62100038/'	,
'https://www.trip.com/travel-guide/attraction/macau/ilha-verde-91695/'	,
'https://www.trip.com/travel-guide/attraction/macau/studio-city-auditorium-39016900/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-parisian-theatre-30276481/'	,
'https://www.trip.com/travel-guide/attraction/macau/macao-open-top-bus-18535222/'	,
'https://www.trip.com/travel-guide/attraction/macau/camoes-garden-and-grotto-76041/'	,
'https://www.trip.com/travel-guide/attraction/macau/kun-iam-temple-76048/'	,
'https://www.trip.com/travel-guide/attraction/macau/our-lady-of-ftima-church-macau-76058/'	,
'https://www.trip.com/travel-guide/attraction/macau/st-lazarus-church-76066/'	,
'https://www.trip.com/travel-guide/attraction/macau/old-protestant-cemetery-78459/'	,
'https://www.trip.com/travel-guide/attraction/macau/tak-seng-on-pawnshop-museum-20905941/'	,
'https://www.trip.com/travel-guide/attraction/macau/parque-de-d-assumpcao-20905947/'	,
'https://www.trip.com/travel-guide/attraction/macau/nine-macau-chapel-of-our-lady-of-seven-sorrows-76069/'	,
'https://www.trip.com/travel-guide/attraction/macau/coloane-library-22847603/'	,
'https://www.trip.com/travel-guide/attraction/macau/tap-seac-gallery-22847435/'	,
'https://www.trip.com/travel-guide/attraction/macau/museum-of-the-macau-security-forces-20905952/'	,
'https://www.trip.com/travel-guide/attraction/macau/patio-de-chon-sau-31693292/'	,
'https://www.trip.com/travel-guide/attraction/macau/macao-historical-archives-22847433/'	,
'https://www.trip.com/travel-guide/attraction/macau/lianhua-square-51634273/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-design-center-50675633/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-sightseeing-tower-skywalk-33785584/'	,
'https://www.trip.com/travel-guide/attraction/macau/kid-s-city-22847438/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-east-asian-games-dome-20905946/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-city-hall-23865349/'	,
'https://www.trip.com/travel-guide/attraction/macau/aomenmeishi-square-39267458/'	,
'https://www.trip.com/travel-guide/attraction/macau/shangjiaxing-association-39227057/'	,
'https://www.trip.com/travel-guide/attraction/macau/aomen-xiwanhu-square-51620829/'	,
'https://www.trip.com/travel-guide/attraction/macau/ferreira-do-amaral-plaza-84902406/'	,
'https://www.trip.com/travel-guide/attraction/macau/leal-senado-building-78460/'	,
'https://www.trip.com/travel-guide/attraction/macau/lotus-square-81973/'	,
'https://www.trip.com/travel-guide/attraction/macau/fengtang-no-10-creative-park-st-lazarus-church-district-creative-industries-promotion-association-51628775/'	,
'https://www.trip.com/travel-guide/attraction/macau/st-dominic-s-square-58276675/'	,
'https://www.trip.com/travel-guide/attraction/macau/street-steel-heavy-metal-bike-gallery-macau-77446603/'	,
'https://www.trip.com/travel-guide/attraction/macau/bodhi-temple-51633248/'	,
'https://www.trip.com/travel-guide/attraction/macau/vr-zone-macau-96844144/'	,
'https://www.trip.com/travel-guide/attraction/macau/qube-at-the-venetian-31981564/'	,
'https://www.trip.com/travel-guide/attraction/macau/nezha-exhibition-hall-39226964/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-londoner-macao-107330861/'	,
'https://www.trip.com/travel-guide/attraction/macau/mandarin-s-house-81972/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-cathedral-of-the-nativity-of-our-lady-macau-76055/'	,
'https://www.trip.com/travel-guide/attraction/macau/largo-de-santo-agostinho-82862/'	,
'https://www.trip.com/travel-guide/attraction/macau/dangzi-bridge-22847440/'	,
'https://www.trip.com/travel-guide/attraction/macau/mgm-grand-praca-24601470/'	,
'https://www.trip.com/travel-guide/attraction/macau/lin-fung-temple-76050/'	,
'https://www.trip.com/travel-guide/attraction/macau/tam-kung-temple-76054/'	,
'https://www.trip.com/travel-guide/attraction/macau/ua-galaxy-cinemas-30637132/'	,
'https://www.trip.com/travel-guide/attraction/macau/galaxy-macau-13452339/'	,
'https://www.trip.com/travel-guide/attraction/macau/taipa-housesmuseum-76808/'	,
'https://www.trip.com/travel-guide/attraction/macau/st-francis-xavier-church-76068/'	,
'https://www.trip.com/travel-guide/attraction/macau/taipa-village-22847601/'	,
'https://www.trip.com/travel-guide/attraction/macau/r-do-regedor-94435/'	,
'https://www.trip.com/travel-guide/attraction/macau/jardm-de-sfranclsco-76045/'	,
'https://www.trip.com/travel-guide/attraction/macau/reservoir-13293702/'	,
'https://www.trip.com/travel-guide/attraction/macau/loi-wo-temple-10534933/'	,
'https://www.trip.com/travel-guide/attraction/macau/the-fire-services-museum-20905950/'	,
'https://www.trip.com/travel-guide/attraction/macau/datanshan-jiaoye-park-10534970/'	,
'https://www.trip.com/travel-guide/attraction/macau/gates-of-understanding-20905945/'	,
'https://www.trip.com/travel-guide/attraction/macau/dr-carlos-d-assumpcao-park-31690673/'	,
'https://www.trip.com/travel-guide/attraction/macau/arts-garden-22847686/'	,
'https://www.trip.com/travel-guide/attraction/macau/adream-workshop-3d-30007129/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-tung-sin-tong-charitable-society-22847429/'	,
'https://www.trip.com/travel-guide/attraction/macau/lu-huanbu-xingjing-xiuqi-park-51633287/'	,
'https://www.trip.com/travel-guide/attraction/macau/escada-do-coxo-56683036/'	,
'https://www.trip.com/travel-guide/attraction/macau/parque-infantil-do-chunambeiro-51628610/'	,
'https://www.trip.com/travel-guide/attraction/macau/macau-timepiece-museum-81956073/'


]
c=0
for url in link:
    print(url)

    headers = {

        'Accept-Encoding': 'gzip, deflate, br',
        'Accept-Language': 'en-US;q=0.8',
        'Cache-Control': 'max-age=0',

    }

    response = requests.get(url,headers=headers)
    soup = BeautifulSoup(response.text, "html.parser")

    if soup.find("h1", {"class": "basicName"}) is None:
        tittle =""
    else:
        tittle = soup.find("h1", {"class": "basicName"}).text

    if soup.find("i", {"class": "gs-trip-iconfont icon-opentime"}) is None:
        opentime =""
    else:
        opentime = soup.find("i", {"class": "gs-trip-iconfont icon-opentime"}).findNext("div").find("span", {"class": "field"}).text

    if soup.find("i", {"class": "gs-trip-iconfont icon-info"}) is None:
        rec_time =""
    else:
        rec_time = soup.find("i", {"class": "gs-trip-iconfont icon-info"}).findNext("div").find("span", {"class": "field"}).text

    if soup.find("i", {"class": "gs-trip-iconfont icon-address"}) is None:
        address =""
    else:
        address = soup.find("i", {"class": "gs-trip-iconfont icon-address"}).findNext("div").find("span", {"class": "field"}).text

    if soup.find("i", {"class": "gs-trip-iconfont icon-phone"}) is None:
        phone =""
    else:
        phone = soup.find("i", {"class": "gs-trip-iconfont icon-phone"}).findNext("div").find("span", {"class": "field"}).text

    if soup.find("span", {"class": "price"}) is None:
        price =""
    else:
        price = soup.find("span", {"class": "price"}).text

    if soup.find("div", {"class": "two-box"}) is None:
        content =""
    else:
        content = soup.find("div", {"class": "two-box"}).find("div").find("div").find("div").text
    image_list =[]
    for div in soup.find_all('div', {"class": "carousel"}):
        print(div)
        for image in div.find_all('img'):
            image_list.append(image["src"])




    att =[tittle,opentime,rec_time,address,phone,price,content,str(image_list)]
    all_att.append(att)

with xlsxwriter.Workbook('data.xlsx') as workbook:
    worksheet = workbook.add_worksheet()

    for row_num, data in enumerate(all_att):
        worksheet.write_row(row_num, 0, data)


