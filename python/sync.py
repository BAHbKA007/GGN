from zeep import Client
from requests import Session
from requests.auth import HTTPBasicAuth
from zeep.transports import Transport
import io, os, requests
from datetime import datetime
import logging
import urllib3
import time

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

logging.basicConfig(filename=os.path.abspath(os.curdir).replace("\\", "/") + "/SyncLog.txt",
                            filemode='a',
                            format='%(asctime)s,%(msecs)d %(name)s %(levelname)s %(message)s',
                            datefmt='%H:%M:%S',
                            level=logging.ERROR)

i = 0

while True:

    # Wenn Uhrezeit zwischen 05:00 und 18:00 Uhr
    if time.strftime("%H:%M:%S") > '05:00:00' and time.strftime("%H:%M:%S") < '18:00:00':

        # checken ob unter qm. nicht aktuelle einträge existieren
        r = requests.get("http://localhost/python/check", verify=False)

        if r.text != '0' or i >= 60:
        
            try:
                zeit = datetime.now().strftime("%d.%m.%Y %H.%M.%S")
                filename = os.path.abspath(os.curdir).replace("\\", "/") + "/responses/"+ zeit + ".xml"
                wsdl = "https://database.globalgap.org/globalgapaxis/services/Globalgap?wsdl"
                session = Session()
                session.auth = HTTPBasicAuth('SP473600', 'GRST2015!')
                client = Client(wsdl, transport=Transport(session=session))

                requestData = {
                    'action': 'getBookmark' ,
                    'version': '2.4' ,
                    'request': '<ns2:getBookmarkRequest xmlns:ns2="http://www.globalgap.org/"><bookmarkListIdList><bookmarkId>59588</bookmarkId></bookmarkListIdList></ns2:getBookmarkRequest>'
                }

                response = client.service.doRequest(**requestData)
                
                # process Unicode text
                with io.open(filename, 'w', encoding='utf8') as f:
                    f.write(response)

                r = requests.post("https://qm.leichtbewaff.net/soap/python/import", data={'xml': response}, verify=False)
                print("\n\n" + datetime.now().strftime("%d.%m.%Y %H:%M:%S"))
                print(r.status_code, r.reason)
                print(r.text)

                i = 0
                
            except:
                logging.exception('')
        
        else:
            i = i + 1
        

        time.sleep(60)

    else:
        print('außerhalb der festgelegten Sync Zeit')
        time.sleep(3600)


# while True:
    
#     if time.strftime("%H:%M:%S") > '05:00:00' and time.strftime("%H:%M:%S") < '18:00:00':
        



