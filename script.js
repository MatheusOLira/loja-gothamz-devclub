function comprar(produto_id) {

    if (!usuarioLogado) {
        alert("Você precisa fazer login com a Steam para comprar!");
        window.location.href = "steam_login.php";
        return;
    }

    fetch('pagamento.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            produto_id: produto_id
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.init_point) {

            // salva a referência do pedido
            localStorage.setItem("ref", data.external_reference);

            // vai para o pagamento
            window.location.href = data.init_point;

        } 
        else {
            console.error(data);
            alert('Erro ao criar pagamento');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erro na conexão com o servidor');
    });
}