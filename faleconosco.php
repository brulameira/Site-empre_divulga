<?php
include('menu2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/faleconosco.css">
    <link rel = "stylesheet" href = "css/index.css">
    <title>Formulário</title>
    
</head>
<body>
    <section>
        <h2>Contato</h2>
        <form action="https://api.staticforms.xyz/submit" method="post">
    <label>Nome</label>
    <input type="text" name="name" placeholder="Digite seu nome" autocomplete="off" required>
    <label>Email</label>
    <input type="email" name="email" placeholder="Digite seu email" autocomplete="off" required>
    <label>Mensagem</label>
    <textarea name="message" cols="30" rows="10" placeholder="Digite sua mensagem" required></textarea>
    <button type="submit">Enviar</button>
    <input type="hidden" name="accessKey" value="3426aa6c-54e3-4c39-ad76-72196508138f">
    <input type="hidden" name="redirectTo" value="http://localhost/empredivulga_1/sucesso.html">
</form>

    </section>
    
</body>
</html>