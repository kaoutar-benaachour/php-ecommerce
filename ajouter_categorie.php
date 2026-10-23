<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Ajouter categorie</title>
</head>
<body>
     <?php include 'include/nav.php' ?>
     <div class="container py-2">
         <h4>Ajouter categorie</h4>
         <?php
         //“Is ajouter set in the POST data?” isset= is set?
         if(isset($_POST['ajouter'])){
             $libelle = $_POST['libelle'];
             $description = $_POST['description'];
             $icone = $_POST['icone'];

             if(!empty($libelle) && !empty($description)){
                 require_once 'include/database.php';
                 $sqlState = $pdo->prepare('INSERT INTO categorie(libelle, description, icone) VALUES(?,?,?)');
                 $sqlState->execute([$libelle,$description,$icone]);
                 header('Location: categories.php');
             }else{
                 ?>
                 <div class="alert theme-danger" role="alert">
                     <p>libelle, description sont obligatoires</p>
                 </div>
         <?php
             }
         }
         ?>
         <form method="post">
             <label class="form-label">Libelle</label>
             <input type="text" class="form-control" name="libelle">

             <label class="form-label">Description</label>
             <textarea class="form-control" name="description" ></textarea>

             <label class="form-label">Icone</label>
             <input type="text" class="form-control" name="icone">

             <input type="submit" value="Ajouter utilisateur" class="btn btn-primary my-2" name="ajouter">
         </form>
     </div>

</body>
</html>