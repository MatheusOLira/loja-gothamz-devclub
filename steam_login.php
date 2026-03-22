<?php
session_start();
require 'vendor/autoload.php';

use LightOpenID;

$openid = new LightOpenID('gothamz.shop');

// 🔑 SUA API KEY DA STEAM
$apiKey = "A103FE5283280E327C3A752EEEC2BA2B";

if (!$openid->mode) {

    // Vai pra Steam
    $openid->identity = 'https://steamcommunity.com/openid';
    header('Location: ' . $openid->authUrl());
    exit;

} elseif ($openid->mode == 'cancel') {

    echo 'Login cancelado';

} else {

    if ($openid->validate()) {

        $steamid = str_replace(
            "https://steamcommunity.com/openid/id/",
            "",
            $openid->identity
        );

        $_SESSION['steamid'] = $steamid;

        // 🔥 BUSCAR DADOS DO USUÁRIO
        $url = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apiKey&steamids=$steamid";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['response']['players'][0])) {

            $player = $data['response']['players'][0];

            $_SESSION['steam_name'] = $player['personaname'];
            $_SESSION['steam_avatar'] = $player['avatarfull'];

        }

        // Redireciona
        header("Location: index.php");
        exit;

    } else {
        echo "Falha na validação";
    }
}