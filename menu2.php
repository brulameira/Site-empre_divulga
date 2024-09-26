<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empre Divulga</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/menu2.css">
    <!--Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <a href="#"><img src="logo/logo1.png" alt="Logo" width="123.5px" height="81.5px" /></a>
        </div>
        <div class="search-box">
            <form method="POST" action="pesquisando.php">
                <input type="text" id="search-input" name="buscado" placeholder="Pesquise aqui..." />
                <select id="city-select" name="cidade">
                    <option value="all">Todas as cidades</option>
                </select>
                <button class="btn btn-sm btn-success mt-2" type="submit">Pesquisar</button>
            </form>

        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="faleconosco.php">Fale conosco</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a href="cadastro.html">Cadastra-se</a></li>
            <li><button><a href="php/login.php">Entrar</a></button></li>
        </ul>
    </nav>



    <script>
        fetch('js/municipios.json')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('city-select');
                data.data.sort((a, b) => a.Nome.localeCompare(b.Nome)).forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.Nome; // Use o nome da cidade como valor
                    option.textContent = `${city.Nome} - ${city.Uf}`;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>