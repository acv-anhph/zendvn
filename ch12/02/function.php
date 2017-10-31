<?php

function createData(){
    $filmData = array(
        array('year' => 2013, 'image' => 'face-reader.jpg'		, 'name' => 'The Face Reader'),
        array('year' => 2014, 'image' => 'pirate-fairy.jpg'		, 'name' => 'The Pirate Fairy'),
        array('year' => 2013, 'image' => 'sadako.jpg'			, 'name' => 'Sadako'),
        array('year' => 2007, 'image' => 'resident-evil-3.jpg'	, 'name' => 'Resident Evil 3'),
        array('year' => 2009, 'image' => 'american-pie-7.jpg'	, 'name' => 'American Pie 7'),
        array('year' => 2013, 'image' => 'jailbait.jpg'			, 'name' => 'Jailbait'),
        array('year' => 2013, 'image' => 'epic.jpg'				, 'name' => 'Epic'),
        array('year' => 2014, 'image' => 'spider-man-2.jpg'		, 'name' => 'The Spider Man'),
        array('year' => 2013, 'image' => 'kill-darlings.jpg'	, 'name' => 'Kill Your Darlings'),
        array('year' => 2013, 'image' => 'zone-pro-site.jpg'	, 'name' => 'Zone Pro Site'),
        array('year' => 2013, 'image' => 'the-internship.jpg'	, 'name' => 'The Internship'),
        array('year' => 2013, 'image' => 'jeune-and-jolie.jpg'	, 'name' => 'Jeune And Jolie'),
        array('year' => 2014, 'image' => 'blackJacks.jpg'		, 'name' => 'BlackJacks'),
    );
    return $filmData;
}

function getElements($arrData, $position, $totalItems){
    $newArrray	= array_slice($arrData, $position, $totalItems);
    return $newArrray;
}