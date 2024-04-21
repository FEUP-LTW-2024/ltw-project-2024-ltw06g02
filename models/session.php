<?php

class Session {
    private array $messages;
    private $userID;
    private $username;

    public function __construct() {
        session_start();
        
        // $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
        //unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
        return isset($_SESSION['username']);    
    }

    public function logout() {
        session_destroy();
    }

    public function getUserId() : ?int {
        return isset($_SESSION['userID']) ? $_SESSION['userID'] : null;    
    }

    public function getUsername() : ?string {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function getEmail() : ?string {
        return isset($_SESSION['email']) ? $_SESSION['email'] : null;
    }

    public function getAvatar() : ?string {
        return isset($_SESSION['avatar']) ? $_SESSION['avatar'] : null;
    }

    public function setUserId() {
        $db = getDatabaseConnection();
        $stmt = $db->prepare(
            "SELECT userID FROM users WHERE username=?"
        );
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->execute();
        $id = $stmt->fetch();

        $this->userID = $id['userID'];
        $_SESSION['userID'] = $id['userID'];
    }

    public function setUsername(string $username) {
        $this->username = $username;
        $_SESSION['username'] = $username;
    }

    public function setEmail(string $email) {
        $_SESSION['email'] = $email;
    }

    public function setAvatar(string $avatar) {
        $_SESSION['avatar'] = $avatar;
    }

    public function addMessage(string $type, string $text) {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
        return $this->messages;
    }

    public function isSellerOfProduct(int $productUserID) : bool {
        // Verifica se o usuário logado é o vendedor do produto
        return $this->isLoggedIn() && $this->getUserId() === $productUserID;
    }
}

?>