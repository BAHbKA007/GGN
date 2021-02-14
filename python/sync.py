from zeep import Client
from requests import Session
from requests.auth import HTTPBasicAuth
from zeep.transports import Transport
from datetime import datetime
import io, os, requests, logging, urllib3, time, ctypes, sys

ctypes.windll.kernel32.SetConsoleTitleW("GGN Synchronizer Gemüsering")

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

logging.basicConfig(filename=os.path.abspath(os.curdir).replace("\\", "/") + "/SyncLog.txt",
                            filemode='a',
                            format='%(asctime)s,%(msecs)d %(name)s %(levelname)s %(message)s',
                            datefmt='%H:%M:%S',
                            level=logging.ERROR)
proxies = {'http': 'http://192.168.98.254:8080', 'https': 'http://192.168.98.254:8080'}

i = 60
startzeit = time.strftime("%H:%M:%S")

while True:

    #sys.exit(0)

    print(i)
    # Wenn Uhrezeit zwischen 05:00 und 18:00 Uhr
    if time.strftime("%H:%M:%S") > '05:00:00' and time.strftime("%H:%M:%S") < '18:00:00':

        # checken ob unter qm. nicht aktuelle einträge existieren
        # r = requests.get("https://qm.leichtbewaff.net/python/check", verify=False)

        #if r.text != '0' or i >= 60:
        if i >= 60:
        
        #try:
            zeit = datetime.now().strftime("%d.%m.%Y %H.%M.%S")
            filename = os.path.abspath(os.curdir).replace("\\", "/") + "/responses/"+ zeit + ".xml"
            wsdl = "https://database.globalgap.org/globalgapaxis/services/Globalgap?wsdl"
            session = Session()
            session.proxies = proxies
            session.auth = HTTPBasicAuth('SP473600', 'GRST2015!')
            client = Client(wsdl, transport=Transport(session=session))

            requestData = {
                'action': 'getBookmark' ,
                'version': '2.4' ,
                'request': '<ns2:getBookmarkRequest xmlns:ns2="http://www.globalgap.org/"><bookmarkListIdList><bookmarkId>59588</bookmarkId></bookmarkListIdList></ns2:getBookmarkRequest>'
            }
            print("Request Global Gap...")
            response = client.service.doRequest(**requestData)

            print("Respons verarbeiten...")
            # process Unicode text
            with io.open(filename, 'w', encoding='utf8') as f:
                f.write(response)
                
            print("Request MySql Datenabnk")
            r = requests.post("https://qm.leichtbewaff.net/soap/python/import", proxies=proxies, data={'xml': response}, verify=False)
            print("\n\n" + datetime.now().strftime("%d.%m.%Y %H:%M:%S"))
            print(r.status_code, r.reason)
            print(r.text)

            i = 0
            
        #except:
            logging.exception('')
        
        else:
            i = i + 1

        time.sleep(60)

    else:
        print('außerhalb der festgelegten Sync Zeit')
        time.sleep(3600)


# while True:
    
#     if time.strftime("%H:%M:%S") > '05:00:00' and time.strftime("%H:%M:%S") < '18:00:00':
        



