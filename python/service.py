import psutil
import time
from sys import executable
from subprocess import Popen, CREATE_NEW_CONSOLE

def running3(program, scriptname):
    for pid in psutil.pids(): # Iterates over all process-ID's found by psutil,  
        try:
            p = psutil.Process(pid) # Requests the process information corresponding to each process-ID, the output wil look (for example) like this: <psutil.Process(pid=5269, name='Python') at 4320652312>
            if program in p.name(): # checks if the value of the program-variable that was used to call the function matches the name field of the plutil.Process(pid) output (see one line above). So it basically calls <psutil.Process(pid=5269, name='Python') at 4320652312>.name() which is --> 'Python'
                """Check the output of p.name() on your system. For some systems it might print just the program (e.g. Safari or Python) on others it might also print the extensions (e.g. Safari.app or Python.py)."""
                for arg in p.cmdline(): # p.cmdline() echo's the exact command line via which p was called. So it resembles <psutil.Process(pid=5269, name='Python') at 4320652312>.cmdline() which results in (for example): ['/Library/Frameworks/Python.framework/Versions/3.4/Resources/Python.app/Contents/MacOS/Python', 'Start.py'], it then iterates over is splitting the arguments. So in the example you will get 2 results: 1 = '/Library/Frameworks/Python.framework/Versions/3.4/Resources/Python.app/Contents/MacOS/Python' and 2 = 'Start.py'. It will check if the given script name is in any of these.. if so, the function will return True.
                    if scriptname in str(arg):  
                        return True
                    else:
                        pass
            else:
                pass
        except:
            return False
while True:
    if running3('python.exe', 'sync.py'):
        print("Prozess gefunden, kein Handlungsbedarf")
    else:
        print("Prozess nicht gefunden: starte sync.py...")
        Popen([executable, 'sync.py'], creationflags=CREATE_NEW_CONSOLE)
    time.sleep(10800)   
