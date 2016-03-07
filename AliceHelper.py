import speech_recognition as sr
from subprocess import call

# obtain audio from the microphone
r = sr.Recognizer()
while (True) :

    with sr.Microphone() as source:
        print("Say something!")
        audio = r.listen(source)

    try:
        s = r.recognize_sphinx(audio)
        print("Sphinx thinks you said " + s)
    except sr.UnknownValueError:
        print("Sphinx could not understand audio")
    except sr.RequestError as e:
        print("Sphinx error; {0}".format(e))


    if ("exit" in s) :
        break

    call(["php", "./alice.php", "Zarvox", s])

print("done")