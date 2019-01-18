<?php

$connect = mysql_connect("localhost","scsthaicuser","12345678890");

$mapa = "SELECT * FROM pgmq.mapa ";

$dbquery = mysql_query($mapa,$connect);

$geojson = array( 'type' => 'FeatureCollection', 'features' => array());

while($row = mysql_fetch_assoc($dbquery)){

$marker = array(
                'type' => 'Feature',
                'features' => array(
                    'type' => 'Feature',
                    'properties' => array(
                        'title' => "".$row[name]."",
                        'marker-color' => '#f00',
                        'marker-size' => 'small'
                        //'url' => 
                        ),
                    "geometry" => array(
                        'type' => 'Point',
                        'coordinates' => array( 
                                        $row[lat],
                                        $row[lng]
                        )
                    )
                )
    );
array_push($geojson['features'], $marker['features']);
}
?>