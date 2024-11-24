<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Assets/Css/Header.css">
        <link rel="stylesheet" href="Assets/Css/Main.css">
        <link rel="stylesheet" href="Assets/Css/Menu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <title>Cãopanheiro Adoção</title>
    </head>
    <body>
        <!--Cabeçalho-->
        <header>
            <nav id="navbar">
                <a id="nav_logo"><img src="Assets/Img/logo-final.png" alt="Logo Cãopanheiro">Cãopanheiro</a>

                <ul id="nav_list">
                    <li class="nav-item">
                        <a href="Index.html">Início</a>
                    </li>
                    <li class="nav-item active">
                        <a href="">Adoção</a>
                    </li>
                    <li class="nav-item">
                        <a href="Petisco.html">Petiscos e Comidas</a>
                    </li>

                </ul>

                <button class="btn-default">
                    <a href="Formulario.html">Cadastrar cachorro</a>
                </button>

                <button id="mobile_btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>

            <div id="mobile_menu">
                <ul id="mobile_nav_list">
                    <li class="nav-item">
                        <a href="Index.html">Início</a>
                    </li>
                    <li class="nav-item">
                        <a href="adocao.php">Adoção</a>
                    </li>
                    <li class="nav-item">
                        <a href="Petisco.html">Petiscos e Comidas</a>
                    </li>
                </ul>

                <button class="btn-default">
                    <a href="Formulario.html">Cadastrar cachorro</a>
                </button>
            </div>
        </header> 

        <main id="content">
            
            <section id="menu">
                <h2 class="section-title">Adoção</h2>
                <h3 class="section-subtitle">Adote um cãopanheiro!</h3>
                
                
<?php 
            try {
                $pdo = new PDO('sqlite:C:\Users\gabyc\Downloads\ezyzip\cachorro.db');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Criar a tabela se não existir
                $pdo->exec("CREATE TABLE IF NOT EXISTS cachorro (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT,
                    peso TEXT,
                    idade TEXT,
                    raca TEXT,
                    cor TEXT,
                    sexo TEXT,
                    foto TEXT

                )");

            
                
                
                // Consultar dados
                $stmt = $pdo->query("SELECT * FROM cachorro");

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo'<div class="doggos">';
                        echo'<div class="dog">';
                            echo '<div class="paw-img"> <i class="fa-solid fa-paw"></i> </div>';
                            echo '<img src="Assets/Img-dog/'.$row['foto'].'" class="dog-one" alt="Rex">';
                            echo '<h3 class="dog-title">' . $row['nome'] . '</h3>' ;
                            echo '<span class="dog-description">' . " Peso: " . $row['peso'] . " Kg" ."<br>". " Idade: " . $row['idade'] . " anos" . "<br>". " Raca: " . $row['raca'] ."<br>". " Cor: " . $row['cor'] ."<br>". " Sexo: " . $row['sexo'] ."<br>". '</span>';
                            echo '<form action="Excluir.php" method="post">';
                                echo '<input id="nomeid" name="id" type="hidden" value="'. $row['id'] .'">';
                                echo '<button class="btn-default" id="excluir-btn" type="submit" name="excluir" >Deletar<i class="fa-solid fa-paw"></i></button>';
                            echo '</form>';
                        echo'</div>';
                    echo '</div>';
                    echo '<br><br><br>';
                }

            } catch (PDOException $e) {
                echo "Erro ao conectar: " . $e->getMessage();
            }

?>
                    
            </section>
        </main>
        
        <script src="Javascript/Script.js"></script>
    </body>
    </html>
