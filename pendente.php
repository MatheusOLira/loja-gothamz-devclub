<?php
$ref = $_GET['ref'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Aguardando pagamento</title>

<style>
body {
    background: #0a0a0a;
    color: white;
    text-align: center;
    font-family: Arial;
    padding-top: 100px;
}
.loading {
    color: red;
    font-size: 22px;
}
</style>
</head>

<body>

<h1>⏳ Aguardando pagamento...</h1>
<p>Assim que for confirmado, você será redirecionado automaticamente.</p>

<p class="loading">Verificando...</p>

<script>
let ref = "<?php echo $ref; ?>";

// pega do navegador se não vier na URL
if (!ref) {
    ref = localStorage.getItem("ref");
}

if (!ref) {
    document.body.innerHTML = "Erro: pagamento não identificado";
}

// verifica status
setInterval(() => {

    fetch("verificar_status.php?ref=" + ref)
    .then(res => res.json())
    .then(data => {

        if (data.status === "approved") {
            window.location.href = "sucesso.php";
        }

    });

}, 3000);
</script>

</body>
</html>