#!/bin/bash

echo "Custom startup script starting..."
mkdir /html


# Copy 50x.html to /html/
if [ -f "/home/site/wwwroot/50x.html" ]; then
    echo "Copying 50x.html to /html/"
    cp /home/site/wwwroot/50x.html /html/50x.html
else
    echo "50x.html not found in /home/site/wwwroot/"
fi
