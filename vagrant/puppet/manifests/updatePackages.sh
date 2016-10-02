#!/usr/bin/env bash
uname -a | grep Ubuntu
if [ $? -eq 0 ]; then
    apt-get update
else
    yum update
fi
