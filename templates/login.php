<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blank Page with Modal</title>
    <link href="../css/login.css" rel="stylesheet">
</head>
<body>

<dialog id="loginDialog">
    <button class="close-button" aria-label="Close alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
    </button>
    <p>JUNTA-TE A NÓS E VENDE ROUPA EM SEGUNDA MÃO SEM PAGAR TAXAS!</p>
    <form id="loginForm" action="../actions/login.php" method="POST">
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <button type="submit" id="loginBtn">Login</button>
    </form>
    <p>Não tens uma conta? <a href="#" id="createAccountLink">Cria uma</a>.</p>
</dialog>

<dialog id="createAccountDialog">
    <button class="close-button" aria-label="Close alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
    </button>
    <p>CRIA UMA CONTA COM O E-MAIL</p>
    <form id="createAccountForm" action="../actions/register.php" method="POST">
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <button type="submit" id="registerBtn">Continuar</button>
    </form>
</dialog>

<button class="show" id="showLogin">Show Login Modal</button>

<script>
    const loginDialog = document.getElementById("loginDialog");
    const createAccountDialog = document.getElementById("createAccountDialog");
    const showLoginBtn = document.getElementById("showLogin");
    const closeLoginBtn = loginDialog.querySelector(".close-button");
    const closeCreateAccountBtn = createAccountDialog.querySelector(".close-button");
    const loginForm = document.getElementById("loginForm");
    const createAccountForm = document.getElementById("createAccountForm");
    const createAccountLink = document.getElementById("createAccountLink");

    showLoginBtn.addEventListener("click", () => {
        loginDialog.showModal();
    });

    closeLoginBtn.addEventListener("click", () => {
        loginDialog.close();
    });

    closeCreateAccountBtn.addEventListener("click", () => {
        createAccountDialog.close();
    });

    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        console.log("Email:", email);
        console.log("Password:", password);
    });

    createAccountLink.addEventListener("click", (event) => {
        event.preventDefault();
        loginDialog.close();
        createAccountDialog.showModal();
    });

    createAccountForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const fullName = document.getElementById("fullName").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        console.log("Full Name:", fullName);
        console.log("Email:", email);
        console.log("Password:", password);
    });
</script>

</body>
</html>