from zeep import Client
from requests import Session
from requests.auth import HTTPBasicAuth
from zeep.transports import Transport
import io, os, requests
from datetime import datetime
import logging 

logging.basicConfig(filename=os.path.abspath(os.curdir).replace("\\", "/") + "/SyncLog.txt",
                            filemode='a',
                            format='%(asctime)s,%(msecs)d %(name)s %(levelname)s %(message)s',
                            datefmt='%H:%M:%S',
                            level=logging.ERROR)

try:
    time = datetime.now().strftime("%d.%m.%Y %H.%M.%S")
    filename = os.path.abspath(os.curdir).replace("\\", "/") + "/python/responses/"+ time + ".xml"
    wsdl = "https://database.globalgap.org/globalgapaxis/services/Globalgap?wsdl"
    session = Session()
    session.auth = HTTPBasicAuth('SP473600', 'GRST2015!')
    client = Client(wsdl, transport=Transport(session=session))

    requestData = {
        'action': 'getBookmark' ,
        'version': '2.1' ,
        'request': '<ns2:getBookmarkRequest xmlns:ns2="http://www.globalgap.org/"><bookmarkListIdList><bookmarkId>59025</bookmarkId></bookmarkListIdList></ns2:getBookmarkRequest>'
    }

    response = client.service.doRequest(**requestData)
    print(os.path.abspath(os.curdir))

    
    # process Unicode text
    with io.open(filename, 'w', encoding='utf8') as f:
        f.write(response)

    r = requests.post("https://qm.leichtbewaff.net/soap/python/import", data={'xml': response})
    print(r.text)
    print(r.status_code, r.reason)
except:
    logging.exception('')
