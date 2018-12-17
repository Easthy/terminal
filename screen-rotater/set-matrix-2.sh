#!/bin/bash

# Touchscreen possible signatures
DEVICES=("Logitech Lenovo USB Optical Mouse" "HID 1aad:0001")

for ix in ${!DEVICES[*]}
do
    echo $DEVICE
    # Search for device by signature
    devlist=$(xinput --list | grep "${DEVICES[$ix]}" | sed -n 's/.*id=\([0-9]\+\).*/\1/p')
    # Set transformation matrix property
    for dev in $devlist
    do
        echo $dev
    done
done
