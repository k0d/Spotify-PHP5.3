<?php

header('Content-type: text/plain; charset=UTF-8');

require_once 'src/phpSpotify/Spotify.php';

$spotify = new phpSpotify\Spotify();

$artist='winnerbäck';

var_dump($spotify->searchArtist($artist));

var_dump(phpSpotify\Spotify::searchArtist($artist));