<?php

header('Content-type: text/plain; charset=UTF-8');

require_once 'src/phpSpotify/Spotify.php';

$apiversion=1;
$spotifyurl='http://ws.spotify.com/';
$artist='winnerbäck';
$albumuri='spotify:album:6G9fHYDCoyEErUkHrFYfs4';

$spotify = new phpSpotify\Spotify($spotifyurl,$apiversion);

$spotify->lookup($albumuri);
var_dump($spotify->results()->info);

$spotify->searchArtist($artist);
var_dump($spotify->results()->info);