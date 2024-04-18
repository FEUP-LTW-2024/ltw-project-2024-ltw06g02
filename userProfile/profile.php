<?php
declare(strict_types=1);

// Incluir arquivos de conexão com o banco de dados e classe de usuário
require_once '../database/connection.php';
require_once '../database/User.php';

// Obtém a conexão com o banco de dados
$db = getDatabaseConnection();

// ID do usuário específico que você quer buscar
$specificUserId = 5; // Substitua pelo ID do usuário desejado

// Query para obter os dados do usuário específico
$query = "SELECT * FROM users WHERE userID = :userId";
$stmt = $db->prepare($query);
$stmt->execute(['userId' => $specificUserId]);
$user = $stmt->fetch();

// Função para exibir os itens do usuário
function displayUserItems(PDO $db, int $userId)
{
    $stmt = $db->prepare("SELECT * FROM product WHERE userID = :userId");
    $stmt->execute(['userId' => $userId]);
    $userItems = $stmt->fetchAll();

    foreach ($userItems as $item) {
        echo '<div class="item">';
        echo '<img src="' . $item['images'] . '" alt="' . $item['name'] . '" />';
        echo '<p>Preço: $' . $item['price'] . '</p>';
        echo '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="profile.css" />
</head>

<body>
    <div class="profile">
        <div class="profile-picture">
            <img src="<?php echo $user['avatar']; ?>" alt="Foto de Perfil do Usuário" />
        </div>
        <div class="profile-info">
            <img src="<?php echo $user['avatar']; ?>" alt="Avatar do Usuário" />
            <h1><?php echo $user['username']; ?></h1>
            <p>Email: <?php echo $user['email']; ?></p>
            <!-- Adicione outros detalhes do perfil do usuário conforme necessário -->
            <button>Editar Perfil</button>
        </div>
    </div>
    <div class="item-grid">
        <h2>Produtos à Venda</h2>
        <?php
        // Exibir os itens do usuário
        displayUserItems($db, $specificUserId);
        ?>
    </div>
</body>

</html>
