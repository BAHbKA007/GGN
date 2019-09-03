from zeep import Client
from requests import Session
from requests.auth import HTTPBasicAuth
from zeep.transports import Transport
import io, os, requests
from datetime import datetime
import logging 


datei = input('Welche Datei aus dem responses soll importiert werden? ')
filename = os.path.abspath(os.curdir).replace("\\", "/") + "/responses/" + datei

# process Unicode text
with io.open(filename, 'r', encoding='utf8') as f:
    xml = f.read()


r = requests.post("https://qm.leichtbewaff.net/soap/python/import", data={'xml': xml}, verify=False)
print(r.text)
print(r.status_code, r.reason)
input()
