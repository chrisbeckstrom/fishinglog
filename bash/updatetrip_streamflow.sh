#!/bin/bash

# update ALL trips weather!
# start at tripid = 1 and move up, adding weather information along the way

# wunderground api: can only access it 60 times per day, 8 times per minute max
#		60 times / 24 hours = 2.5 times per hour
#		less:	2 times per hour = 48 times per day

# the above is wrong!
# the correct limits are:
# 500 calls per day, 10 calls per minute
# 500 / 24 = 20.83 calls per hour
# 20 calls per hour = every 3 minutes

TRIPID=457
	 until [  $TRIPID -lt 1 ]; do
		 echo ">>>>>>>>> TRIPID $TRIPID <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<"
		 let TRIPID-=1
		 echo "php updatetrip_streamflow.php $TRIPID"
		 php updatetrip_streamflow.php $TRIPID
		 echo "done updating tripid $TRIPID- sleeping now..."
		 echo "updated streamflow for trip $TRIPID" >> streamflowupdate.log
		 sleep 5
	 done
