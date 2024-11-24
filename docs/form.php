 <?php /*

   try {
    $pdo = new PDO('sqlite:cachorro.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inserir dados
    $stmt = $pdo->prepare("INSERT INTO cachorro (nome, peso,idade,raca,cor,sexo) VALUES (:nome, :peso, :idade, :raca,:cor,:sexo)");
    $stmt->execute(['nome' => 'Rex', 'idade' => 5]);



    } catch (PDOException $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
*/
?>

<?php
// Diretório onde a imagem será salva
$pasta = 'C:/Users/gabyc/Downloads/ezyzip/Assets/Img-dog/';

// Verifica se o diretório existe, se não, cria
if (!is_dir($pasta)) {
    mkdir($pasta, 0755, true);
}

// Verifica se o arquivo foi enviado
if (isset($_FILES['foto'])) {
    $imagem = $_FILES['foto'];
    $nomeArquivo = $imagem['name'];
    $tmpNome = $imagem['tmp_name'];
    $erro = $imagem['error'];

    // Verifica se houve erro no upload
    if ($erro === UPLOAD_ERR_OK) {
        // Garante que o nome do arquivo seja único
        $nomeUnico = uniqid() . '-' . basename($nomeArquivo);
        $caminhoFinal = $pasta . $nomeUnico;

        // Move o arquivo para o diretório especificado
        if (move_uploaded_file($tmpNome, $caminhoFinal)) {
            echo "Imagem enviada com sucesso: <a href='$caminhoFinal'>$nomeUnico</a>";
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Erro no envio da imagem: $erro";
    }
} else {
    echo "Nenhuma imagem foi enviada.";
}

// Conectar ao banco SQLite
try {
    $pdo = new PDO('sqlite:C:\Users\gabyc\Downloads\ezyzip\cachorro.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST['nome'];
        $peso = $_POST['peso'];
        $idade = $_POST['idade'];
        $raca = $_POST['raca'];
        $cor = $_POST['cor'];
        $sexo = $_POST['sexo'];

        // Verificar se os campos não estão vazios
        if (!empty($nome) && !empty($peso) && !empty($idade) && !empty($raca) && !empty($cor) && !empty($sexo)) {
            // Inserir os dados no banco
            $stmt = $pdo->prepare("INSERT INTO cachorro (nome, peso,idade,raca,cor,sexo,foto) VALUES (:nome, :peso,:idade,:raca,:cor,:sexo,:foto)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':peso', $peso);
            $stmt->bindParam(':idade', $idade);
            $stmt->bindParam(':raca', $raca);
            $stmt->bindParam(':cor', $cor);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':foto', $nomeUnico);
            $stmt->execute();

            echo "cachorro cadastrado com sucesso!";
            header('Location: adocao.php');
            exit();
        } else {
            echo "Por favor, preencha todos os campos.";
        }
    } else {
        echo "Requisição inválida.";
       
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ou executar: " . $e->getMessage();
}
?>
