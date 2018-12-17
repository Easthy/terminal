#!/bin/sh

# Touchscreen possible signatures
DEVICES=('Logitech Lenovo USB Optical Mouse' 'HID 1aad:0001')

for DEVICE in $DEVICES
do
    # Search for device by signature
    devlist=$(xinput --list | grep "$DEVICE" | sed -n 's/.*id=\([0-9]\+\).*/\1/p')
    # Set transformation matrix property
    for dev in $devlist
    do
        xinput set-prop $dev 'Coordinate Transformation Matrix' -1 0 1 0 1 0 0 0 1 
    done
done



