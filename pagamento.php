<?php
require 'vendor/autoload.php';
session_start();

if (!isset($_SESSION['steamid'])) {
    echo json_encode([
        "erro" => "Usuário não autenticado"
    ]);
    exit;
}

// ⚠️ Use preferencialmente via config.php depois
MercadoPago\SDK::setAccessToken("API_DO_MERCADO_PAGO");

// Dados vindos do frontend
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['produto_id'])) {
    echo json_encode(["erro" => "Requisição inválida"]);
    exit;
}

// 🔥 Pegar SteamID da sessão (ajuste conforme seu login Steam)
$steamid = $_SESSION['steamid'] ?? null;

// 🔒 Tabela segura de produtos
$produtos = [
    1 => ["titulo" => "1000 Coins", "preco" => 10, "coins" => 1000],
    2 => ["titulo" => "2000 Coins", "preco" => 20, "coins" => 2000],
    3 => ["titulo" => "3000 Coins", "preco" => 30, "coins" => 3000],
    4 => ["titulo" => "5500 Coins", "preco" => 50, "coins" => 5500],
    5 => ["titulo" => "11500 Coins", "preco" => 100, "coins" => 11500],
    6 => ["titulo" => "17500 Coins", "preco" => 150, "coins" => 17500]
];

// Recebe ID
$produto_id = $input['produto_id'] ?? null;

// Validação
if (!isset($produtos[$produto_id])) {
    echo json_encode(["erro" => "Produto inválido"]);
    exit;
}

// Dados seguros
$produto = $produtos[$produto_id];

$titulo = $produto['titulo'];
$preco = $produto['preco'];
$coins = $produto['coins'];

// Segurança básica
if (!$steamid) {
    echo json_encode(["erro" => "Usuário não logado"]);
    exit;
}

$preference = new MercadoPago\Preference();
$preference->auto_return = "approved";

$item = new MercadoPago\Item();
$item->title = $titulo;
$item->quantity = 1;
$item->unit_price = $preco;

$preference->items = array($item);

// 🔥 AQUI ESTÁ O MAIS IMPORTANTE (METADATA)
$preference->metadata = [
    "steamid" => $steamid,
    "coins" => $coins
];

// URLs de retorno
$preference->back_urls = array(
  "success" => "https://SEUSITE/sucesso.php",
  "failure" => "https://SEUSITE.shop/erro.php",
  "pending" => "https://SEUSITE.shop/pendente.php"
);

$preference->auto_return = "approved";

$external_reference = uniqid("pedido_");
$preference->external_reference = $external_reference;

$preference->save();

if ($preference->id) {
    echo json_encode([
        "init_point" => $preference->init_point,
        "external_reference" => $external_reference
    ]);
} else {
    echo json_encode([
        "erro" => "Erro ao criar preferência"
    ]);
}