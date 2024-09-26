<?php
require('./php/conexao.php');

$produtos = []; 
$totalProdutos = 0; 

if (isset($_POST['buscado'])) {
    $buscado = $_POST['buscado'];
    $UF = $_POST['cidade'];

    $query = "SELECT 
        c.tipo AS categoria,
        sc.tipo AS subcategoria,
        p.nome AS produto_nome,
        p.descricao,
        p.id_prod,
        up.preco,
        up.prazo,
        f.url AS imagem_url,
        l.cidade,
        l.estado
    FROM produto p
    INNER JOIN Sub_categoria sc ON p.id_sub = sc.id_sub
    INNER JOIN categoria c ON sc.id_cat = c.id_cat
    INNER JOIN usuario_produto up ON p.id_prod = up.id_prod
    INNER JOIN foto f ON up.id_usuario_produto = f.id_usuario_produto
    INNER JOIN usuario u ON up.id_usuario = u.id_usuario
    INNER JOIN localidade l ON u.idlocal = l.id_local
    WHERE 
        (c.tipo LIKE '%$buscado%' 
        OR sc.tipo LIKE '%$buscado%' 
        OR p.nome LIKE '%$buscado%')
        AND (l.cidade LIKE '%$UF%' OR '$UF' = 'all')
    ORDER BY c.tipo, p.nome";

    $result = $con->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[$row['categoria']][] = $row;
            $totalProdutos++; // Increment count for each product
        }
    }
}

include('menu2.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pesquisa.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Resultados da Pesquisa</title>
    <!-- CSS and other head elements here -->
</head>
<body>

   
    <div class="content">
        <?php if (empty($produtos)) { ?>
            <div class="alert alert-danger alert-sm">
                Nenhum produto encontrado.
            </div>
        <?php } else { ?>
            <div class="product-list">
                <?php foreach ($produtos as $categoria => $produtoArray) { ?>
                    <h2><?php echo htmlspecialchars($categoria); ?></h2>
                    <?php foreach ($produtoArray as $produto) { ?>
                        <div class="list-group-item">
                            <img src="<?php echo 'php/' . htmlspecialchars($produto['imagem_url']); ?>" class="product-img" alt="Foto do Produto">
                            <div class="product-info">
                                <h3 class="product_name"><?php echo htmlspecialchars($produto['produto_nome']); ?></h3>
                                <p class="description"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                                <p class="location"><?php echo htmlspecialchars($produto['cidade']) . ', ' . htmlspecialchars($produto['estado']); ?></p>
                                <p class="price"><b>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></b></p>
                            </div>
                            <div class="botao">
                            <button> <a href="prodDescricao.php?id_prod=<?php echo $produto['id_prod']; ?>" class="add btn btn-primary">Visitar</a> </button>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="result-count">
                Total de resultados encontrados: <?php echo $totalProdutos; ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
