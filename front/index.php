<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Liste des categories</title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
     <div class="container py-2">
         <h4><i class="fa-solid fa-list"></i>Liste des categories</h4>
         <ul class="list-group list-group-flush w-25">
         <?php
         include_once '../include/database.php';
         $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
         foreach ($categories as $categorie) {
             ?>
             <li class="list-group-item">
                 <a class="btn btn-light" href="categorie.php?id=<?= $categorie->id ?>">
                        <i class="<?= $categorie->icone ?>"></i><?= $categorie->libelle ?>
                 </a>
             </li>
             <?php
         }
         ?>
         </ul>

     </div>

</body>
</html>