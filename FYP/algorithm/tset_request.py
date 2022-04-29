import requests

response = requests.get("https://bis.dsat.gov.mo:37812/macauweb/routeLine.html?routeName=2&direction=0&language=zh-tw&ver=3.6.7")
print(response.text())