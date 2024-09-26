<?php
include('menu2.php');
require('./php/conexao.php');



$sql = "SELECT 
        c.tipo AS categoria,
        sc.tipo AS subcategoria,
        p.nome AS produto_nome,
        p.descricao,p.id_prod,
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
    ORDER BY c.tipo, p.nome";

$result = $con->query($sql);
$produtos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[$row['categoria']][] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/produto.css">
    
    <!-- -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
 
    <title>Empre Divulga</title>
</head>

<body>
    <!-- carrossel banner -->
    <div class="image-gallery">
       
        <img id="gallery-image" src="Banner/cartaz2.png" alt="banner">
      
    </div>
    
    <!-- ------------------menu produtos--------------------------- -->
    <nav>
    <ul>
        <li>
            <a href="#"><span class="material-icons">restaurant_menu</span> Salgados e Doces</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Doces">Doces</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Salgados">Salgados</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Marmitas">Marmitas</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Sorvete">sorvetes</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Lanche">Lanches</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#"><span class="material-icons">checkroom</span> Moda e Beleza</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Brechó">Brechó</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Costureira">Costureira</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Manicure">Manicure</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Cabeleireiro">Cabeleireiro</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Barbeiro">Barbeiro</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#"><span class="material-icons">devices</span> Design e Técnologia</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Programador">Programador</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Tecnico de Informática">Tecnico de Informática</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Tecnico de Eletrônica">Tecnico de Eletrônica</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Designer Gráfico">Designer Gráfico</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Gráfica">Gráfica</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Editor de fotos/videos">Editor de fotos/videos</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#"><span class="material-icons">groups</span> Assistência e Assessoria</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Advogado">Advogado</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Contador">Contador</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Corretor">Corretor</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Consultor">Consultor</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Despachante">Despachante</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#"><span class="material-icons">brush</span> Arte e Artesanato</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Grafiteiro">Grafiteiro</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Pintor">Pintor</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Desenhista">Desenhista</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Croche">Croche</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Escultor">Escultor</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Ceramista">Ceramista</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#"><span class="material-icons">house</span> Serviços Domesticos</a>
            <div class="sub-menu-1">
                <ul>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Diarista">Diarista</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Babá">Babá</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Piscineiro">Piscineiro</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Passadeiro">Passadeiro</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Entregador">Entregador</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Carreto">Carreto</a></li>
                    <li><a href="pesquisarCategorias.php?sub_categoria=Pedreiro">Pedreiro</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>


    <!-- ---------------- ----- Produtos Salgado e Doces -------------------- -->

    <main class="container mt-5">
        <?php foreach ($produtos as $categoria => $produtos_categoria): ?>
            <header>
                <h1><?php echo htmlspecialchars($categoria); ?></h1>
            </header>

            <?php foreach ($produtos_categoria as $produto): ?>
                <div class="card">
                    <div class="image">
                        <img src="<?php echo 'php/' . htmlspecialchars($produto['imagem_url']); ?>" class="product-img" alt="Foto do Produto">
                    </div>
                    <div class="caption">
                        <p class="product_name"><?php echo htmlspecialchars($produto['produto_nome']); ?></p>
                        <p class="price"><b>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></b></p>
                        <p class="Local"><?php echo htmlspecialchars($produto['cidade'] . ', ' . $produto['estado']); ?></p>
                    </div>
                   <button> <a href="prodDescricao.php?id_prod=<?php echo $produto['id_prod']; ?>" class="add btn btn-primary">Visitar</a> </button>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </main>

</body>
</html>
         

</body>

</html>
