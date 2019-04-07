<?php 

require 'vendor/autoload.php';

use Application\Session\Session;
use Application\Index\Index;
use Application\Profile\Profile;

Session::SessionCreate();

$Profile = new Profile();
$Profile->ChangePassword($_POST['old-passwd'], $_POST['new-passwd'], $_POST['conf-new-passwd']);

?>

<h1>Moje konto</h1>
<h3>Witaj <?php $_SESSION['Username']; ?> </h3>

Zmień hasło
<form action method='post'>
    Stare hasło: <input type="password" name="old-passwd"><br />
    Nowe hasło: <input type="password" name="new-passwd"><br />
    Potwierdź nowe hasło: <input type="password" name="conf-new-passwd"><br />
    <input type="submit" value="Potwierdź" name="chg-passwd">
</form>
Twoje pojazdy:
<div class='ads'>
    <?php 
        $Profile->FetchCars();
    ?>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/script.js"></script>