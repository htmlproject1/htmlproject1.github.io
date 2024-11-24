<?php
// Conectar ao banco de dados
$db = new PDO('sqlite:cachorro.db'); // Substitua 'banco.db' pelo seu banco de dados

// Verificar se o formulário foi enviado
if (isset($_POST['excluir'])) {
    // Obter o ID do item a ser excluído
    $id = $_POST['id'];

    // Preparar a query para excluir o item
    $query = "DELETE FROM cachorro WHERE id = :id"; // Substitua 'tabela' pelo nome da sua tabela
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a query
    if ($stmt->execute()) {
        echo "Item excluído com sucesso!";
        header('Location: adocao.php');
        exit();
    } else {
        echo "Erro ao excluir item!";
    }
}
?>