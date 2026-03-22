<?php
session_start();

if (!isset($_SESSION['steamid'])) {
    header("Location: index.php");
    exit;
}

$steamid = $_SESSION['steamid'];

// 📂 caminho do JSON
$caminho = "C:/Program Files (x86)/CFTools Software GmbH/Architect/Agent/deployments/GothamZChernarus/profiles/ModsSparda/Store/PlayerAccounts/$steamid.json";

$coins = 0;

if (file_exists($caminho)) {
    $data = json_decode(file_get_contents($caminho), true);
    $coins = $data['coins'] ?? 0;
}

// 📜 HISTÓRICO DE COMPRAS
$historico = [];
$arquivoHistorico = "data/$steamid.json";

if (file_exists($arquivoHistorico)) {
    $historico = json_decode(file_get_contents($arquivoHistorico), true);
}

// dados da Steam
$nome = $_SESSION['steam_name'] ?? "Usuário";
$avatar = $_SESSION['steam_avatar'] ?? "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="./css/painel.css">
</head>

<body>

    <div class="card">
        <img src="<?= $avatar ?>" width="80"><br><br>
        <h2><?= $nome ?></h2>

        <p>SteamID:</p>
        <small><?= $steamid ?></small>

        <h3 class="coins"><?= $coins ?> coins</h3>

        <br>

        <a href="index.php" style="color:red;">Voltar para a Loja</a>
    </div>

    <div class="historico">

        <h2>🧾 Histórico de Compras</h2>

        <table>
            <tr>
                <th>Data</th>
                <th>Coins</th>
                <th>Status</th>
            </tr>

            <?php if (empty($historico)): ?>
                <tr>
                    <td colspan="3">Nenhuma compra encontrada</td>
                </tr>
            <?php else: ?>
                <?php foreach (array_reverse($historico) as $compra): ?>
                    <tr>
                        <td><?= $compra['data'] ?></td>
                        <td><?= $compra['coins'] ?></td>
                        <td class="<?= $compra['status'] == 'approved' ? 'status-ok' : 'status-pending' ?>">
                            <?= $compra['status'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>

    </div>

</body>
</html>