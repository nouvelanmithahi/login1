<?php
session_start();

if(isset($_SESSION['id'])) {
    header('Location: index.php');
}

include_once("header.php");

if(isset($_POST['connexion'])){
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    //Vérifier si les champs sont remplis 
    if(!empty($email) && !empty($password)){
        $loginUser = $db->prepare("SELECT * FROM users WHERE email = ?");
        $loginUser->execute(array($email));
        
        //Vérifier si on trouve au moins un utilisateur
        if($loginUser->rowCount() > 0){
            $userInfo = $loginUser->fetch();
            //Verifier si le mot de passe correspond à celui de la base de données
            if(password_verify($password, $userInfo['password'])){
                // Connecter l'utilisateur
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['nom'] = $userInfo['nom'];
                $_SESSION['email'] = $userInfo['email'];

                header('Location: index.php');
            } else{
                $erreur = "Adresse mail ou mot de passe incorrecte";
            }
        } else{
            $erreur = "Adresse mail ou mot de passe incorrecte";
        }
    } else{
        $erreur = "Veuillez remplir tous les champs";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 offset-lg-4 mt-5">
            <h2 class="text-center">Connexion</h2>
            <form action="" method="post">
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="btn btn-primary  w-100 mb-3" type="submit" name="connexion">Se connecter</button>

                <?php if (isset($erreur)) { ?>
                    <div
                        class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><?php echo $erreur; ?></strong>
                    </div>

                <?php } ?>
            </form>
        </div>
    </div>
</div>

<?php 
include_once("footer.php");
?>