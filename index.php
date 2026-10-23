<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
     <?php include 'include/nav.php' ?>
     <div class="container py-2">
         <h4>Ajouter utilisateur</h4>
         <?php
         if(isset($_POST['ajouter'])){
             $login = $_POST['login'];
             $pwd = $_POST['password'];

             if(!empty($login) && !empty($pwd)){
                 //use require_once instead of include when the website should not load without that file
                 require_once  'include/database.php';
                 $date = date("Y-m-d");
                 //Pour des raisons de securite en utilise prapare()
                 // quand en veux recuperer des valeurs entrees par l'utilisateur
                 $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUES(null,?,?,?)');
                 $sqlState->execute([$login, $pwd, $date]);
                 //Redirection
                 header('Location: connexion.php');
             }else{
                 ?>
                 <div class="alert theme-danger" role="alert">
                     <p>login, password sont obligatoires</p>
                 </div>
                 <?php
             }
         }
         ?>
         <form method="post">
             <label class="form-label">Login</label>
             <input type="text" class="form-control" name="login">

             <label class="form-label">Password</label>
             <input type="password" class="form-control" name="password">
             <input type="submit" value="Ajouter utilisateur" class="btn btn-primary my-2" name="ajouter">
         </form>
     </div>

</body>
</html>