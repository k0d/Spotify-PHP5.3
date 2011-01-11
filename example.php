<?php

ini_set('display_errors',true);
header('Content-type: text/html; charset=UTF-8');

require_once 'src/phpSpotify/Spotify.php';

$apiversion = 1;
$spotifyurl = 'http://ws.spotify.com/';
$artist = 'winnerbäck';
$albumuri = 'spotify:album:3iViuCMTrATqk2lFMS3dyT';
$artisturi = 'spotify:artist:5B38ZGYpd0msq1LKOyz2r9';
$trackuri = 'spotify:track:5VPpfKFPqoNCMArDAOPXnk';
$track = 'russia privet';

$spotify = new phpSpotify\Spotify();
$spotify2 = new phpSpotify\Spotify($spotifyurl,$apiversion);

title('Call: $results=$spotify->lookup("'.$albumuri.'")');
$results = $spotify->lookup($albumuri);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());
title('Call: $results->getCount()');
dump_pre($results->getCount());
title('Call: $results->getType()');
dump_pre($results->getType());
title('Call: $results->getAlbum()->getName()');
dump_pre($results->getAlbum()->getName());
title('Call: $results->getAlbum()->getUri()');
dump_pre($results->getAlbum()->getUri());
title('Call: $results->getAlbum()->getArtisturi()');
dump_pre($results->getAlbum()->getArtisturi());
title('Call: $results->getAlbum()->getArtist()');
dump_pre($results->getAlbum()->getArtist());
title('Call: $results->getAlbum()->getYear()');
dump_pre($results->getAlbum()->getYear());
title('Call: $results->getAlbum()->isAvailableIn("Se")');
dump_pre($results->getAlbum()->isAvailableIn('Se'));
title('Call: $results->getAlbum()->isAvailableIn("UNKNOWN")');
dump_pre($results->getAlbum()->isAvailableIn('UNKNOWN'));
title('Call: $results->getRawresults()');
dump_pre($results->getRawresults());

rule();

title('Call: $results=$spotify->lookup("'.$artisturi.'")');
$results = $spotify->lookup($artisturi);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());
title('Call: $results->getCount()');
dump_pre($results->getCount());
title('Call: $results->getType()');
dump_pre($results->getType());
title('Call: $results->getArtist()->getName()');
dump_pre($results->getArtist()->getName());
title('Call: $results->getArtist()->getUri()');
dump_pre($results->getArtist()->getUri());
title('Call: $results->getRawresults()');
dump_pre($results->getRawresults());

rule();

title('Call: $results=$spotify->lookup("'.$trackuri.'")');
$results = $spotify->lookup($trackuri);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());
title('Call: $results->getCount()');
dump_pre($results->getCount());
title('Call: $results->getType()');
dump_pre($results->getType());
title('Call: $results->getTrack()->getName()');
dump_pre($results->getTrack()->getName());
title('Call: $results->getTrack()->getUri()');
dump_pre($results->getTrack()->getUri());
title('Call: $results->getTrack()->isAvailable()');
dump_pre($results->getTrack()->isAvailable());
title('Call: $results->getTrack()->isAvailableIn("Se")');
dump_pre($results->getTrack()->isAvailableIn('Se'));
title('Call: $results->getTrack()->isAvailableIn("UNKNOWN")');
dump_pre($results->getTrack()->isAvailableIn('UNKNOWN'));
title('Call: $results->getTrack()->getArtists()');
title('&nbsp;&nbsp;Foreach Call: $resultartist->name');
title('&nbsp;&nbsp;Foreach Call: $resultartist->href');
foreach($results->getTrack()->getArtists() as $resultartist) {
    dump_pre($resultartist->name);
    dump_pre($resultartist->href);
}
title('Call: $results->getTrack()->getLength()');
dump_pre($results->getTrack()->getLength());
title('Call: $results->getTrack()->getTracknumber()');
dump_pre($results->getTrack()->getTracknumber());
title('Call: $results->getTrack()->getPopularity()');
dump_pre($results->getTrack()->getPopularity());
title('Call: $results->getTrack()->getAlbum()');
dump_pre($results->getTrack()->getAlbum());
title('Call: $results->getTrack()->getAlbum()->name');
dump_pre($results->getTrack()->getAlbum()->name);
title('Call: $results->getTrack()->getAlbum()->href');
dump_pre($results->getTrack()->getAlbum()->href);
title('Call: $results->getTrack()->getAlbum()->released');
dump_pre($results->getTrack()->getAlbum()->released);
title('Call: $results->getRawresults()');
dump_pre($results->getRawresults());

rule();

title('Call: $results=$spotify->searchArtist("'.$artist.'")');
$results = $spotify->searchArtist($artist);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());
title('Call: $results->getCount()');
dump_pre($results->getCount());
title('Call: $results->getQuery()');
dump_pre($results->getQuery());
title('Call: $results->getType()');
dump_pre($results->getType());
title('Call: $results->getLimit()');
dump_pre($results->getLimit());
title('Call: $results->getOffset()');
dump_pre($results->getOffset());
title('Call: $results->getPage()');
dump_pre($results->getPage());
title('Call: $results->getArtists()');
title('&nbsp;&nbsp;Foreach Call: $resultartist->getName()');
foreach($results->getArtists() as $resultartist) {
    dump_pre($resultartist->getName());
}

rule();

title('Call: $results=$spotify->searchTrack("'.$track.'")');
$results = $spotify->searchTrack($track);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());
title('Call: $results->getCount()');
dump_pre($results->getCount());
title('Call: $results->getTracks()');
title('&nbsp;&nbsp;Foreach Call: $resulttrack->getName()');
title('&nbsp;&nbsp;Foreach Call: $resulttrack->getArtists()');
foreach($results->getTracks() as $resulttrack) {
    dump_pre($resulttrack->getName());
    dump_pre($resulttrack->getArtists());
}

rule();

title('Call: $results=$spotify->foo("'.$artist.'")');
$results = $spotify->foo($artist);
title('Call: $results->getInfo()');
dump_pre($results->getInfo());

// Some little functions to aide in example display :)
function dump_pre($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function title($title) {
    echo '<b>'.$title.'</b>'."<br />\n";
}

function rule() {
    echo '<hr />'."\n";
}
