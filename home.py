# file : home.py

from email.mime import application
from flask import Flask, render_template

app = Flask (__name__)

@app.route('/welcome')
def welcome():
    return render_template ('index.html')

@app.route('/home')
def home():
    return render_template ('index1.html')

@app.route('/about')
def about():
    return render_template ('index2.html')

@app.route('/credits')
def credits():
    return render_template ('index3.html')

if  __name__ == '__name__' :
    application.run(debug=True)