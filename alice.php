<?php

$bot = 'b69b8d517e345aba';
$url = 'http://sheepridge.pandorabots.com/pandora/talk?botid=' . $bot . '&skin=custom_input';
$custThing = 'ba76077aae7d67d8';
$voice = $argv[1];
$input = $argv[2];

$fields = array(
    'input' => urlencode($input),
    'botcust2' => urlencode($custThing)
);

//url-ify the data for the POST
$fields_string = '';
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

$matches = [];
$pattern = '/A\.L\.I\.C\.E\..+\/b>(.+).+</';
$out = preg_match_all($pattern, $result, $matches);

error_log(print_r($matches[1][0], 1));
exec('say -v ' . $voice . ' "' . $matches[1][0] . '"');
