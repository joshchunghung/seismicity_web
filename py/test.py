#!/usr/bin/env python3
#-*- coding: utf-8 -*-
import json
from flask import Flask, escape, request
app = Flask(__name__)

app.route('/', methods=['POST'])
def ajax_post_view():
    stdate = request.form.get("stdate")
    data = {'my_data':stdate}
    return JsonResponse(data)

if __name__ == '__main__':
    ajax_post_view()

