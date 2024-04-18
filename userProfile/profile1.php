<?php
declare(strict_types=1);

// Incluir o arquivo de sessão e criar uma instância da classe Session
require_once '../session.php';
$session = new Session();

// Verificar se o usuário está logado, redirecionar para a página de login se não estiver
if (!$session->isLoggedIn()) {
    header('Location: /login.php');
    exit;
}

// Incluir arquivos de conexão com o banco de dados e classe de usuário
require_once '../database/connection.php';
require_once '../database/User.php';

$db = getDatabaseConnection();

// Query para obter os dados do usuário atual
$userArticles = getUserArticles($db, $session->getUserId());

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
            <h1><?php echo $user['username']; ?></h1>
            <p>Email: <?php echo $user['email']; ?></p>
            <!-- Adicione outros detalhes do perfil do usuário conforme necessário -->
            <button>Editar Perfil</button>
        </div>
    </div>
    <div class="item-grid">
        <?php
        // Exibir os itens do usuário
        displayUserItems($db, $session->getUserId());
        ?>
    </div>
</body>

</html>