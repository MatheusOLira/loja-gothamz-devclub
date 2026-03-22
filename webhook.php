<?php

require 'vendor/autoload.php';
require 'config.php';

MercadoPago\SDK::setAccessToken(MP_ACCESS_TOKEN);

// 🔥 LOG INICIAL
file_put_contents("log.txt", "Webhook chamado\n", FILE_APPEND);

// 🔍 CAPTURA BODY (se existir)
$body = file_get_contents("php://input");
file_put_contents("log.txt", "Body: " . $body . "\n", FILE_APPEND);

// 🔍 CAPTURA GET
file_put_contents("log.txt", "GET: " . print_r($_GET, true) . "\n", FILE_APPEND);

// 🎯 PEGA PAYMENT ID (GET ou BODY)
$payment_id = null;

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];
} else {
    $data = json_decode($body, true);
    if (isset($data['data']['id'])) {
        $payment_id = $data['data']['id'];
    }
}

if ($payment_id) {

    $payment = MercadoPago\Payment::find_by_id($payment_id);
    $ref = $payment->external_reference ?? null;

    if ($payment && $payment->status == "approved") {

        $steamid = $payment->metadata->steamid ?? null;
        $coins = $payment->metadata->coins ?? 0;

        file_put_contents("log.txt", "SteamID: $steamid | Coins: $coins\n", FILE_APPEND);

        if ($steamid && $coins > 0) {

            // 🔒 ANTI DUPLICAÇÃO
            $arquivo = "logs/$payment_id.txt";

            // garante que a pasta existe
            if (!is_dir("logs")) {
                mkdir("logs", 0777, true);
            }

            // tenta criar lock
            $fp = fopen($arquivo, "x");

            if ($fp === false) {
                file_put_contents("log.txt", "Pagamento duplicado ou erro ao criar arquivo\n", FILE_APPEND);
                exit;
            }

            fwrite($fp, "ok");
            fclose($fp);

            if ($ref) {
            file_put_contents("logs/$ref.txt", "approved");
            }
            file_put_contents("log.txt", "Pagamento aprovado\n", FILE_APPEND);
            

            // 🔥 ENVIA PARA NODE
            $url = "http://179.94.101.109:3000/entregar";

            $dataPost = [
                "steamid" => $steamid,
                "coins" => $coins
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataPost));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                file_put_contents("log.txt", "Erro CURL: " . curl_error($ch) . "\n", FILE_APPEND);
            } else {
                file_put_contents("log.txt", "Resposta Node: " . $response . "\n", FILE_APPEND);
            }

            curl_close($ch);

            // 📜 HISTÓRICO (SEGURO - NÃO QUEBRA O SISTEMA)
            try {

                $steamid = $payment->metadata->steamid ?? null;
                $coins = $payment->metadata->coins ?? 0;

                if ($steamid && $coins > 0) {

                    if (!is_dir("data")) {
                        mkdir("data", 0777, true);
                    }

                    $arquivo = "data/$steamid.json";

                    if (file_exists($arquivo)) {
                        $historico = json_decode(file_get_contents($arquivo), true);
                    } else {
                        $historico = [];
                    }

                    $historico[] = [
                        "data" => date("d/m/Y H:i:s"),
                        "coins" => $coins,
                        "status" => "approved",
                        "payment_id" => $payment_id
                    ];

                    file_put_contents($arquivo, json_encode($historico, JSON_PRETTY_PRINT));
                }

            } catch (Exception $e) {
                file_put_contents("log.txt", "Erro histórico: " . $e->getMessage() . "\n", FILE_APPEND);
            }

        } else {
            file_put_contents("log.txt", "SteamID ou coins inválidos\n", FILE_APPEND);
        }

    } else {
        file_put_contents("log.txt", "Pagamento não aprovado\n", FILE_APPEND);
    }

} else {
    file_put_contents("log.txt", "Payment ID não encontrado\n", FILE_APPEND);
}

http_response_code(200);