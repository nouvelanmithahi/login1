<?php
include_once("header.php");

if (isset($_POST['inscription'])) {
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirmpwd = $_POST['confirmpwd'];

    //Vérifier si les champs sont remplis
    if (!empty($nom) && !empty($email) && !empty($password) && !empty($confirmpwd)) {
        //Vérifier si tous les 2 mots de passes correspondent 
        if ($password == $confirmpwd) {
            // Vérifier si l'email est déjà utilisé
            $checkEmail = $db->prepare("SELECT * FROM users WHERE email = ?");
            $checkEmail->execute(array($email));

            if ($checkEmail->rowCount() == 0) {
                //Vérifier si le mot de passe depasse 4 caractères.
                if (strlen($password) >= 4) {
                    // Insertion
                    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

                    $insetUser = $db->prepare("INSERT INTO users(nom,email,password) VALUES (?,?,?)");
                    $insetUser->execute(array($nom, $email, $passwordhash));

                    $succes = "Votre compte a été créé avec succès !";
                } else {
                    $erreur = "Le mot de passe doit contenir au moins 4 caractères";
                }
            } else {
                $erreur = "Cette adresse email est déjà utilisée";
            }
        } else {
            $erreur = "Les 2 mot de passes ne correspondent pas";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 offset-lg-4 mt-5">
            <h2 class="text-center">Inscription</h2>
            <form action="" method="post">
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="floatingName" placeholder="Username" name="name">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" name="confirmpwd">
                    <label for="floatingPassword">Confirm Password</label>
                </div>

                <button class="btn btn-primary  w-100 mb-3" type="submit" name="inscription">S'inscrire</button>

                <?php if (isset($erreur)) { ?>
                    <div
                        class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><?php echo $erreur; ?></strong>
                    </div>

                   
                <?php } ?>

                <?php if (isset($succes)) {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><?= $succes; ?></strong>
                    </div>
                    
                    <script>
                        var alertList = document.querySelectorAll(".alert");
                        alertList.forEach(function (alert) {
                            new bootstrap.Alert(alert);
                        });
                    </script>
                    
                <?php } ?>
            </form>
        </div>
    </div>
</div>

<?php 
include_once("footer.php");
?>