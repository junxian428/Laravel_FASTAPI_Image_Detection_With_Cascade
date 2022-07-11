#import pandas as pd
import shutil
from fastapi import FastAPI, Request, File, UploadFile
from fastapi.middleware.cors import CORSMiddleware
import base64
from fastapi.encoders import jsonable_encoder
from fastapi.responses import JSONResponse
import requests
from pydantic import BaseModel
import json
#C:\Users\USer\Desktop1\XLSXPython
#print (df)
import os
import cv2
import webbrowser

app = FastAPI()

origins = [
    "http://localhost",
    "http://localhost:8000/upload",
    "http://localhost:8000",
    "http://localhost:8080/login",
    "http://localhost:8000/login_status"


]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
@app.get("/Hello")
def time():
    return "Hello"


#class MapData():

#@app.post("/upload")
#async def get_body(request: Request):
       #print(request.headers)

#@app.post('/upload')
#async def upload(file: UploadFile = File(...)):
   #Read the user posted file
   #user_image = await file.read()
   #Decode the received file
   #base64bytes = base64.b64decode(user_image)
   #bytesObj = io.BytesIO(base64bytes)
   #Open the (now) image file
   #pil_image = Image.open(bytesObj)
global boolean_login 


def image_processing():
    print("File Name is " + FILELOCATION)
    current_directory = os.getcwd()
    XML_LOCATION = current_directory + "\\" + "cascade.xml"
    face_cascade=cv2.CascadeClassifier(XML_LOCATION)###path of cascade file
    ## following is an test image u can take any image from the p folder in the temp folder and paste address of it on below line 
    string_location_file = current_directory + "\\" + FILELOCATION
    print(string_location_file)
    img= cv2.imread(string_location_file)
    ###path of image file which we want to detect
    #C:\Users\junxian428\Desktop
    resized = cv2.resize(img,(500,600))
    gray=cv2.cvtColor(resized,cv2.COLOR_BGR2GRAY)
    faces=face_cascade.detectMultiScale(gray,6.5,17)#try to tune this 6.5 and 17 parameter to get good result 
    ##if not getting good result try to train new cascade.xml file again deleting other file expect p and n in temp folder
    number = 0

    for(x,y,w,h) in faces:
        number += 1
        resized=cv2.rectangle(resized,(x,y),(x+w,y+h),(0,255,0),2)
        print(number)

    print(number)
    cv2.imshow('img',resized)
    cv2.waitKey(0)
    cv2.destroyAllWindows()
    if(number >= 1):
        boolean_login = True
        print("login")
        webbrowser.open("http://localhost:8080/success")

    else:
        boolean_login = False
        print("cannot login")
        webbrowser.open("http://localhost:8080/fail")




def login_success():
    return True

def login_failure():
    return False
 


@app.post("/upload")
async def upload(file: UploadFile = File(...)):
    try:
        contents = await file.read()
        with open("uploaded_" + file.filename, "wb") as f:
            global FILELOCATION
            FILELOCATION= "uploaded_" + file.filename
            f.write(contents)
    except Exception:
        return {"message": "There was an error uploading the file"}
    finally:
        await file.close()
    image_processing()
    #return {"Login Status": "Hi"}




