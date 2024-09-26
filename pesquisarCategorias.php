<?php
require('./php/conexao.php');

$produtos = []; 
$totalProdutos = 0;

if (isset($_GET['sub_categoria'])) {
    $subcategoria = $_GET['sub_categoria'];

    // Atualizar a consulta SQL para pesquisar apenas pela subcategoria
    $query = "SELECT 
        c.tipo AS categoria,
        sc.tipo AS sub_categoria,
        p.nome AS produto_nome,
        p.descricao,
        p.id_prod,
        up.preco,
        up.prazo,
        f.url AS imagem_url,
        l.cidade,
        l.estado
    FROM produto p
    INNER JOIN sub_categoria sc ON p.id_sub = sc.id_sub
    INNER JOIN categoria c ON sc.id_cat = c.id_cat
    INNER JOIN usuario_produto up ON p.id_prod = up.id_prod
    INNER JOIN foto f ON up.id_usuario_produto = f.id_usuario_produto
    INNER JOIN usuario u ON up.id_usuario = u.id_usuario
    INNER JOIN localidade l ON u.idlocal = l.id_local
    WHERE 
        sc.tipo = ?";

    $stmt = $con->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    $stmt->bind_param('s', $subcategoria); 
    $stmt->execute();
    $result = $stmt->get_result();

    $totalProdutos = $result->num_rows; 

    if ($totalProdutos > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
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
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="css/pesquisa.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="content">
        <?php if (empty($produtos)) { ?>
            <div class="alert alert-danger alert-sm">
                Nenhum produto encontrado.
            </div>
        <?php } else { ?>
            <div class="product-list">
                <?php foreach ($produtos as $produto) { ?>
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
            </div>
            <div class="result-count">
                Total de resultados encontrados: <?php echo $totalProdutos; ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
