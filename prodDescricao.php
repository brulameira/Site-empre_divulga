<?php
include('menu2.php');
require('./php/conexao.php');

if (!isset($_GET['id_prod']) || empty($_GET['id_prod'])) {
    echo "ID do produto não foi passado.";
    exit;
}

$id_produto = intval($_GET['id_prod']); 

// Consultar os detalhes do produto e do usuário
$sql = "SELECT 
        p.nome AS produto_nome, 
        p.descricao,
        up.preco,
        up.prazo,
        f.url AS imagem_url,
        l.cidade, l.bairro, l.rua,
        l.estado,
        u.nome AS usuario_nome,
        u.foto_perfil,
        u.nome_Micro_empre, u.telefone,u.bio
       
    FROM produto p
    INNER JOIN usuario_produto up ON p.id_prod = up.id_prod
    INNER JOIN foto f ON up.id_usuario_produto = f.id_usuario_produto
    INNER JOIN usuario u ON up.id_usuario = u.id_usuario
    INNER JOIN localidade l ON u.idlocal = l.id_local
    WHERE p.id_prod = ?";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo "Erro na preparação da consulta: " . $con->error;
    exit;
}

$stmt->bind_param("i", $id_produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $produto = $result->fetch_assoc();
} else {
    echo "Produto não encontrado.";
    exit;
}

$sql_social = "SELECT Twitter, Facebook, Google, Linkedin, Instagram, Whatsapp FROM social WHERE id_usuario = ?";
$stmt_social = $con->prepare($sql_social);
$stmt_social->bind_param("i", $produto['id_usuario']);
$stmt_social->execute();
$result_social = $stmt_social->get_result();
$social_links = $result_social->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/descricao.css">

    <title>Detalhes do Produto</title>
</head>

<body>

    <div class="product-details">
        <div class="product-image">

            <img src="<?php echo 'php/' . htmlspecialchars($produto['imagem_url']); ?>" class="product-img" alt="Foto do Produto">
        </div>
        <div class="product-info">
            <h1><?php echo htmlspecialchars($produto['produto_nome']); ?></h1>
            <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
            <p><b>Preço:</b> R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            <p><b>Prazo:</b> <?php echo htmlspecialchars($produto['prazo']); ?> Dias.</p>
            <p><b>Localidade:</b> <?php echo htmlspecialchars($produto['bairro']. ', ' . $produto['rua']. ', ' .$produto['cidade'] . ', ' . $produto['estado']); ?></p>
        </div>
        <div class="user-info">
    <h2>Sobre o Usuário</h2>
    <img src="<?php
                echo !empty($produto['foto_perfil']) ?
                    'php/' . htmlspecialchars($produto['foto_perfil']) :
                    'php/uploads/perfil.png';
                ?>" alt="Foto de Perfil">

    
    <p><b>Empresa:</b> <?php echo htmlspecialchars($produto['nome_Micro_empre']); ?></p>
    <p><b>Telefone:</b> <?php echo htmlspecialchars($produto['telefone']); ?></p>
    <p><b></b> <?php echo htmlspecialchars($produto['bio']); ?></p>

  
</div>
   
</body>

</html>