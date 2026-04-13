<?php
$jogo = "Hogwarts Legacy";
$precoUnitario = 150.00;
$estoque = 5; 
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Loja de Games</title>

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #020000;
        color: #e0e0e0;          
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 15px;
    width: 350px;
    border: 1px solid #ddd;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    color: #000000; 
}

    h1 {
        color: #056515;
        text-align: center;
        margin-top: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #ffffff;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #000000;
        background-color: #ffffff;
        color: black;
        box-sizing: border-box; 
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #015101;
        color: #000;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background-color: #00cc6e;
        transform: scale(1.02);
    }

.resumo {
    margin-top: 20px;
    background: #ffffff;    
    color: #000000;         
    padding: 20px;
    border-radius: 10px;
    width: 350px;
    border-left: 5px solid #00ff88; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.resumo h2 {
    color: #000000;
    margin-top: 0;
}

.resumo ul li {
    color: #333333;
    border-bottom: 1px solid #eee;
    padding: 5px 0;
}

    .sucesso { color: #025f10; }
    .erro { color: #ff4444; }
    
    ul {
    list-style: none; 
    padding: 0;
    font-size: 13px;
    color: #ffffff; }
</style>

</head>
<body>

    <div class="card">
        <h1>Loja GameXP</h1>
        <p><strong>Produto:</strong> <?php echo $jogo; ?></p>
        <p><strong>Preço:</strong> R$ <?php echo number_format($precoUnitario, 2, ',', '.'); ?></p>
        <p><strong>Em estoque:</strong> <?php echo $estoque; ?> unidades</p>

        <form method="POST">
            <label>Quantas unidades?</label>
            <input type="number" name="qtd" value="1" min="1"><br><br>

            <label>Forma de Pagamento:</label>
            <select name="pagamento">
                <option value="pix">PIX (10% desconto)</option>
                <option value="boleto">Boleto (Preço Normal)</option>
                <option value="cartao">Cartão (5% Juros)</option>
            </select><br><br>

            <button type="submit">Finalizar Compra</button>
        </form>
    </div>

    <hr>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quantidadePedida = $_POST['qtd'];
        $metodo = $_POST['pagamento'];

        echo "<h2>Resumo do Pedido:</h2>";

    
        if ($metodo == "pix") {
            $total = ($precoUnitario * $quantidadePedida) * 0.90; 
            echo "<p class='sucesso'>Desconto de PIX aplicado!</p>";
        } 
        else if ($metodo == "cartao") {
            $total = ($precoUnitario * $quantidadePedida) * 1.05;
            echo "<p>Acréscimo de parcelamento aplicado.</p>";
        } 
        else {
            $total = $precoUnitario * $quantidadePedida;
            echo "<p>Preço padrão selecionado.</p>";
        }

        echo "<ul>";
        $i = 1;
        while ($i <= $quantidadePedida) {
            echo "<li>Preparando unidade $i do jogo...</li>";
            $i++;
        }
        echo "</ul>";

        $tentativa = 0;
        do {
            if ($quantidadePedida <= $estoque) {
                echo "<p class='sucesso'>Venda confirmada! Total: R$ " . number_format($total, 2, ',', '.') . "</p>";
            } else {
                echo "<p class='erro'>Erro: Só temos $estoque unidades em estoque!</p>";
            }
            $tentativa++;
        } while ($tentativa < 0);
    }
    ?>

</body>
</html>