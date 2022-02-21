#!/usr/bin/env python3
#-*- coding: utf-8 -*-
import json
from flask import Flask, escape, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/test', methods=['post'])
def postInput():
    stdate= request.get_json()
    data = {'my_data':stdate.get('stdate')}
    return jsonify(data)


if __name__ == '__main__':
    app.run(debug=False)