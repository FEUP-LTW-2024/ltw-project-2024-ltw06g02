<?php
declare(strict_types=1);

// Incluir arquivos de conexão com o banco de dados e classe de usuário
require_once '../database/connection.php';
require_once '../database/User.php';
require_once '../templates/article.tl.php';

// Obtém a conexão com o banco de dados
$db = getDatabaseConnection();

// ID do usuário específico que você quer buscar
$specificUserId = 1; // Substitua pelo ID do usuário desejado

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
    printArticleSection($userItems);
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
            <h1><?php echo $user['username']; ?></h1>
            <p>Email: <?php echo $user['email']; ?></p>
            <!-- Adicione outros detalhes do perfil do usuário conforme necessário -->
            <button>Editar Perfil</button>
        </div>
    </div>

    <!-- Adiciona espaço entre as informações do usuário e os itens à venda -->
    <div class="separator"></div>

    <div class="item-grid">
        <?php
        // Exibir os itens do usuário
        displayUserItems($db, $specificUserId);
        ?>
    </div>
</body>

</html>
