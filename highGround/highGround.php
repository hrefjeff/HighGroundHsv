<?php
/**
 * Copyright (c) Lojix 2017 All Rights Reserved.
 * No part of this website may be reproduced without
 * Lojix's express consent.
 */
/** @noinspection TypeUnsafeComparisonInspection */
if($_SERVER['SERVER_PORT'] == 80){
    header('Location: https:' . _site . "{$_SERVER['PHP_SELF']}");
}
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'config.php';

/** @noinspection UntrustedInclusionInspection */
require_once 'Mustache/Autoloader.php';

//getPopUpData


if($_POST['p']){
    switch($_POST['p']){
        case 'getPopUpData':
            echo getPopUpData();
            break;
        default:
            return FALSE;
    }
} else{
    viewPriorityQueue();
}

function viewPriorityQueue(){
    Mustache_Autoloader::register();
    /** @noinspection PhpUndefinedClassInspection */
    $m = new Mustache_Engine([
                                 'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/views/')
                             ]);
    //29.950513, -90.074139
    $data = [];
    $data['pins'] = [];
    $data['pins'][] = ['pin' => 'Pin 1', 'people' =>  '3', 'injured' => '2', 'vehicle' => 'Truck', 'lat' => '29.950513', 'lng' => '-90.074139', 'priority' => 'high'];
    $data['pins'][] = ['pin' => 'Pin 2', 'people' =>  '2', 'injured' => '1', 'vehicle' => 'Boat', 'lat' => '29.950413', 'lng' => '--90.079139', 'priority' => 'high'];
    $data['pins'][] = ['pin' => 'Pin 3', 'people' =>  '1', 'injured' => '1', 'vehicle' => 'Car', 'lat' => '29.950213', 'lng' => '-90.074134', 'priority' => 'high'];
    $data['pins'][] = ['pin' => 'Pin 4', 'people' =>  '1', 'injured' => '0', 'vehicle' => 'Van', 'lat' => '29.954513', 'lng' => '-90.076139', 'priority' => 'medium'];
    $data['pins'][] = ['pin' => 'Pin 5', 'people' =>  '2', 'injured' => '0', 'vehicle' => 'Truck', 'lat' => '29.950713', 'lng' => '-90.074039', 'priority' => 'medium'];
    $data['pins'][] = ['pin' => 'Pin 6', 'people' =>  '3', 'injured' => '0', 'vehicle' => 'Truck', 'lat' => '29.953513', 'lng' => '-90.078132', 'priority' => 'medium'];
    $data['pins'][] = ['pin' => 'Pin 7', 'people' =>  '4', 'injured' => '0', 'vehicle' => 'Boat', 'lat' => '29.956513', 'lng' => '-90.075139', 'priority' => 'medium'];
    $data['pins'][] = ['pin' => 'Pin 8', 'people' =>  '2', 'injured' => '0', 'vehicle' => 'Car', 'lat' => '29.950613', 'lng' => '-90.084739', 'priority' => 'low'];
    $data['pins'][] = ['pin' => 'Pin 9', 'people' =>  '1', 'injured' => '0', 'vehicle' => 'Car', 'lat' => '29.958513', 'lng' => '-90.074349', 'priority' => 'low'];
    //var_dump($data);

    $queue = $m->render('queueItem', $data);
    //var_dump($queue);
    require __DIR__ . DIRECTORY_SEPARATOR . 'highGroundContent.php';
}

/**
 * @return string
 */
function getPopUpData(){
    $data['people'] = '30';
    $data['injured'] = '2';
    $data['vehicle'] = 'Truck';
    $data['address'] = '228 Holmes Ave Huntsville, AL 35801';
    $data['estArrival'] = '10 min';
    $data['slat'] = '34.755326';
    $data['slng'] = '-86.581191';
    $data['lat'] = $_POST['lat'];
    $data['lng'] = $_POST['lng'];
    return json_encode(['error' => FALSE, 'data' => $data]);


}