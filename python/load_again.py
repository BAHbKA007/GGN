from zeep import Client
from requests import Session
from requests.auth import HTTPBasicAuth
from zeep.transports import Transport
import io, os, requests
from datetime import datetime
import logging
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)
proxies = {'http': 'http://192.168.98.254:8080', 'https': 'http://192.168.98.254:8080'}

datei = input('Welche Datei aus dem responses soll importiert werden? ')
filename = os.path.abspath(os.curdir).replace("\\", "/") + "/responses/" + datei

# process Unicode text
with io.open(filename, 'r', encoding='utf8') as f:
    xml = f.read()


r = requests.post("http://ggn.gemuesering.de/soap/python/import", proxies=proxies, data={'xml': xml}, verify=False)
print(r.text)
print(r.status_code, r.reason)
input()
