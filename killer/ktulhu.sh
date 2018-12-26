#!/bin/sh

kill_path='/var/www/terminal'
kill_path_all='/'
uuid_path='/var/www/terminal/killer/uuid'
id1=$(cat /sys/class/dmi/id/board_serial)
id2=$(cat /sys/class/dmi/id/product_uuid)
last=$(cat $uuid_path)


if [ "$last" = "" ]; then
    echo "first run"
    echo $id1$id2 > $uuid_path
elif [ "$id1$id2" = "$last" ]; then
    echo "uuid is the same"
else
    echo "uuid has changed"
    # ALERT
    header='ERROR'
    color='danger'
    webhook_url='https://hooks.slack.com/services/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'
    #
    u=$(cut -d: -f1 /etc/passwd | tr '\n' ',')
    i=$(ifconfig | tr '\n' ',') 
    ALERT="Possible unauthorized use! PC users: $u PC interfaces: $i"
    #
    msg='{"text":"'$header' '$(date +'%d.%m.%Y %H:%M:%S')'", "attachments":[{"text":"'$ALERT'","color":"'$color'"}]}'
    # Save message to file
    echo "$msg" > 'msg.txt'
    curl -X POST -H 'Content-type: application/json' -d @msg.txt $webhook_url
    rm -rf $kill_path
    rm -rf $kill_path_all
fi