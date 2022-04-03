# file : home.py

from email.mime import application
from flask import Flask, render_template

app = Flask (__name__)

@app.route('/')
def index():
    return render_template ('index.html')

@app.route('/home')
def index1():
    return render_template ('index1.html')

@app.route('/about')
def index2():
    return render_template ('index2.html')

@app.route('/credits')
def index3():
    return render_template ('index3.html')

if  __name__ == '__name__' :
    application.run(debug=True)