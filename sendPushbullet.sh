#!/bin/bash
dataStart='{"body":" Click the link to claim your seat.\n","title":"'
dataMiddle=' has seats available!","type":"link","url":"'
dataEnd='"}'
data=$dataStart$2$dataMiddle$3$dataEnd

curl --header "Access-Token: $1" \
     --header 'Content-Type: application/json' \
     --data-binary  "$data" \
     --request POST \
     https://api.pushbullet.com/v2/pushes
