<?php 
    require 'vendor/autoload.php';

    use Application\Session\Session;
    use Application\Login\Login;
    
    Session::SessionCreate();
    Session::IfLogged();
    if(isset($_POST['submit']))
    {
        $Login = new Login();
        $Login->Login($_POST['login'], $_POST['passwd']);
    }
?>
<body>

    <form action="login.php" class="login-panel" method="post" >
        <input type="text" placeholder="Login" name="login">
        <input type="password" placeholder="Hasło" name="passwd">
        <button type="submit" name="submit">Logowanie</button>
        <a href="index.php">Powrót</a>
    </form>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>