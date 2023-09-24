#!/bin/bash

docker build -t road .
docker run -p 7860:7860 --name gradio -d --rm road