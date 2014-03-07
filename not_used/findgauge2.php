<?php
session_start();

include 'config/config.php';
include 'config/connect.php';

// find a USGS gauge nearby based on lat/lon and waterbody name

//FIRST: try to find one that is nearby



$query = "SELECT ((ACOS(SIN($lat * PI() / 180) * SIN(lat * PI() / 180) + COS($lat * PI() / 180) * COS(lat * PI() / 180) * COS(($lon – lon) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `members` HAVING `distance`<=’10′ ORDER BY `distance` ASC";


// thorapple: 42.859294, -85.485055

SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;

SELECT site_no, station_nm, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians($lon) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance FROM streamflow HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;

SELECT site_no, station_nm, ( 3959 * acos( cos( radians(42.859294) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(-85.485055) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance FROM streamflow HAVING distance < 60 ORDER BY distance LIMIT 0 , 20;


SELECT
  site_no, (
    3959 * acos (
      cos ( radians(42.859294) )
      * cos( radians( lat ) )
      * cos( radians( lon ) - radians(-85.485055) )
      + sin ( radians(-85.485055) )
      * sin( radians( lat ) )
    )
  ) AS distance
FROM streamflow
HAVING distance < 3000
ORDER BY distance
LIMIT 0 , 20;