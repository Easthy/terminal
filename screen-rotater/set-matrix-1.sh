#!/bin/sh

# Detect touchscreen id
if [ "$SEARCH" = "Logitech Lenovo USB Optical Mouse" ]; then 
    exit 1
fi

ids=$(xinput --list | awk -v search="$SEARCH" \
    '$0 ~ search {match($0, /id=[0-9]+/);\
                  if (RSTART) \
                    print substr($0, RSTART+3, RLENGTH-3)\
                 }'\
     )

for i in $ids
do
    # Set transformation matrix
    xinput set-prop $i 'Coordinate Transformation Matrix' -1 0 1 0 1 0 0 0 1 
done

