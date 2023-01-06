<?php
require 'config.php';
require 'templates/header.php';
?>
        <!-- Main -->
        <main>
            <form id="formConnexionAdmin" action="traitementConnexionAdmin.php" method="POST">
                <label class="labelForm" for="login">Identifiant</label>
                <input type="text" class="inputForm" name="login" placeholder="Identifiant">
                <label class="labelForm" for="passwd">Mot de passe</label>
                <input type="password" class="inputForm" name="passwd" placeholder="Mot de passe">
                <input class="boutonForm" type="submit" value="Connexion">
            </form>
        </main>
<?php
require 'templates/footer.php';
?>