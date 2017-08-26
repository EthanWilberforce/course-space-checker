#!/bin/bash
A='{"body":" Click the link to claim your seat.\n'
B='","title":"'
C=' has seats available!","type":"link","url":"'
E='"}'
D=$A$B$2$C$3$E

curl --header "Access-Token: $1" \
     --header 'Content-Type: application/json' \
     --data-binary  "$D" \
     --request POST \
     https://api.pushbullet.com/v2/pushes
