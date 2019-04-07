    <?php 

        require 'vendor/autoload.php';

        use Application\Session\Session;
        use Application\Index\Index;

        Session::SessionCreate();

        $Index = new Index();

    ?>
    
    <div class="menu">
        <div class="logo">Otomoto</div>
            <div class="buttons">
                <?php
                        if(isset($_SESSION['Username']))
                        {
                            print 
                                "
                                    <a class='button profile' href='profile.php'>Moje konto</a>
                                    <a class='button logout' href='logout.php'>Wyloguj</a>
                                    <a class='button new-ad' href='ad-panel.php'>Dodaj ogłoszenie</a>
                                ";
                        }
                        else
                        {
                            print 
                                "
                                    <a class='button login' href='login.php'>Zaloguj</a>
                                    <a class='button register' href='register.php'>Rejestracja</a>
                                ";
                        }
                    ?>
            </div> 
    </div>

    <form class="selects" method="get" action="index.php">
        <input placeholder="Nazwa" name="name">
        <input placeholder="Przebieg" name="course">
        <input placeholder="Cena" name="price">
        <button type="submit" name="find">Szukaj</button>
    </form>

    <div class="ads">

        <?php
            if(isset($_GET['find']))
            {
                return $Index->ReturnResult($_GET['name'], $_GET['course'], $_GET['price']);
            }
            else
            {
                return $Index->ReturnResult($_GET['name'] = '', $_GET['course'] = '', $_GET['price'] = '');
            }
        ?>

    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>