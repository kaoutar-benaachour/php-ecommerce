<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <?php
    if (isset($_POST['connexion'])) {
        $login = $_POST['login'];
        $pwd = $_POST['password'];

        if (!empty($login) && !empty($pwd)) {
            require_once 'include/database.php';
            $sqlState= $pdo->prepare('SELECT * FROM utilisateur 
                                            WHERE login = ? 
                                            AND password = ?');
            $sqlState->execute([$login, $pwd]);
            if ($sqlState->rowCount() > 0) {
                //we use session to store data in it, so that we can use that
                //data on other pages
                $_SESSION['utilisateur'] = $sqlState->fetch();
                header('Location: admin.php');
            }else{
                ?>
                <div class="alert theme-danger" role="alert">
                    <p>login ou mdp incorrecte</p>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="alert theme-danger" role="alert">
                <p>login, password sont obligatoires</p>
            </div>
            <?php
        }
    }
    ?>
    <h4>Connexion</h4>
    <form method="post">
        <label class="form-label">Login</label>
        <input type="text" class="form-control" name="login">

        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
        <input type="submit" value="Connexion" class="btn btn-primary my-2" name="connexion">
    </form>
</div>

</body>
</html>