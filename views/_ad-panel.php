<?php 
    require 'vendor/autoload.php';
    
    use Application\Session\Session;
    use Application\Add\Add;
    use Application\Upload\Upload;

    Session::SessionCreate();
    Session::IfNotLogged();
    $Add = new Add();
    $Upload = new Upload();
    if(isset($_POST['submit']))
    {
        $Add->AddNotice(
            $_POST['model'], 
            $_POST['price'], 
            $_POST['course'],
            $_POST['headlights'], 
            $_POST['wheels'],
            $_POST['mk1'], 
            $_POST['mk2'], 
            $_POST['mk3'], 
            $_POST['rh1'],
            $_POST['taxi']
         );
    $Upload->UploadImage($_FILES['fileToUpload']);
    print "<script> location.replace('action.php?name=add'); </script>";
    }
        
        
?>
    <form action="ad-panel.php" class="ad-panel-container" method="post" enctype="multipart/form-data">
        <select name="model">
            <?php
                $Add->PrepareNoticeCar();
            ?>
        </select>
        <input placeholder="Cena" name="price">
        <input placeholder="Przebieg" name="course">
        <select name="headlights">
            <?php
                $Add->PrepareNoticeHeadLights();
            ?>
        </select>
        <select name="wheels">
            <?php
                $Add->PrepareNoticeWheels();
            ?>
        </select>
        <div class="radio-choice">
            <p class="ad-name">MK1:</p>
            <input type="radio" name="mk1" value='true'>Tak
            <input type="radio" name="mk1" value='false'>Nie
        </div>
        <div class="radio-choice">
            <p class="ad-name">MK2:</p>
            <input type="radio" name="mk2" value='true'>Tak
            <input type="radio" name="mk2" value='false'>Nie
        </div>
        <div class="radio-choice">
            <p class="ad-name">MK3:</p>
            <input type="radio" name="mk3" value='true'>Tak
            <input type="radio" name="mk3" value='false'>Nie
        </div>
        <div class="radio-choice">
            <p class="ad-name">RH1:</p>
            <input type="radio" name="rh1" value='true'>Tak
            <input type="radio" name="rh1" value='false'>Nie
        </div>
        <div class="radio-choice">
            <p class="ad-name">Taxi:</p>
            <input type="radio" name="taxi" value='true'>Tak
            <input type="radio" name="taxi" value='false'>Nie
        </div>
            Zdjęcia:    
            <input type="file" name="fileToUpload[]" multiple> <br />
        <button type="submit" name="submit">Dodaj ogłoszenie</button>
        <a href="index.php">Powrót</a>
    </form>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>