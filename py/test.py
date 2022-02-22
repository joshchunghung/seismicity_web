#!/usr/bin/env python3
#-*- coding: utf-8 -*-
import json
from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
cors = CORS(app, resources={r"/api/*": {"origins": "*"}})

@app.route('/api/test', methods=['post'])
def postInput():
    stdate= request.get_json()
    data = {'my_data':stdate.get('stdate')}
    return jsonify(data)


if __name__ == '__main__':
    app.run('0.0.0.0',debug=False)