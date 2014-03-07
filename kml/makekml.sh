#!/bin/bash
# Run the makekml.php file to generate kml data, and pipe that into a file called "fishingtrips.kml"
# ... and overwrite whatever is already in that file

# set the DATE variable YYYY-MM-DD
DATE=`date +%Y-%m-%d`

# set the TIME variable
TIME=`date +"%T"`

# set the FILENAME
FILENAME=$DATE_$TIME_fishingtrips.kml

# the command
# will probably need to make these absolute paths if running via cron...
php makekml.php > $FILENAME

echo "New kml file generated"

echo "$DATE $TIME - - - - kml file created" >> $FILENAME
