<?php
function getSteamUser($steamid) {

    $apiKey = "A103FE5283280E327C3A752EEEC2BA2B";

    $url = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apiKey&steamids=$steamid";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['response']['players'][0])) {
        return $data['response']['players'][0];
    }

    return null;
}