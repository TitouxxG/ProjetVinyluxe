<?php
if (isset($_POST['button'])) {
    // Code PHP à exécuter lorsque le formulaire est soumis
    // Vous pouvez effectuer des opérations PHP ici
    // ...

    // Redirection vers une autre page ou exécution d'une autre action
    header("Location: register.php");
    exit();
}
?>