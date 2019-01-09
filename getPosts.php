<?php
require('vendor/autoload.php');
use \VK\OAuth;
use \VK\Client;

$vk = new Client\VKApiClient();

$acces_token = "your_access_token";
$filenameOfIds = "promoted_posts_test_task.txt";
$maxIndexesPerQuery = 100;

$inputIds = explode("\n", file_get_contents($filenameOfIds));
$batchIdx = 0;
$posts = array();

while (!empty($inputIds))
{
    $posts["posts"] = implode(",", array_splice($inputIds, 0, $maxIndexesPerQuery));
    $response = $vk->wall()->getById($acces_token, $posts);
    $jsonFile = fopen("posts/" . $batchIdx . ".json", "w");
    $batchIdx++;
    fwrite($jsonFile, json_encode($response));
    fclose($jsonFile);
}

?>