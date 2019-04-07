<?php
    require 'vendor/autoload.php';
    

    use Phelium\Component\reCAPTCHA;
    use Application\Session\Session;
    use Application\Register\Register;

    $reCAPTCHA = new reCAPTCHA('', '');
    echo $reCAPTCHA->getScript();

    Session::SessionCreate();
    Session::IfLogged();

    if(isset($_POST['submit']))
    {
        if ($reCAPTCHA->isValid($_POST['g-recaptcha-response']))
        {
            $Register = new Register();
            $Register->Register($_POST['Username'], $_POST['Password'], $_POST['Password-Conf'], $_POST['Email']);
        }
    }
?>

    <form action="register.php" class="register-panel" method="post">
            <input type="text" placeholder="Login" name="Username">
            <input type="password" placeholder="Hasło" name="Password">
            <input type="password" placeholder="Powtórz hasło" name="Password-Conf">
            <input type="email" placeholder="E-mail" name="Email">
            <?php echo $reCAPTCHA->getHtml(); ?>
            <button type="submit" name="submit">Zarejestruj się</button>
            <a href="index.php">Powrót</a>
    </form>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>
