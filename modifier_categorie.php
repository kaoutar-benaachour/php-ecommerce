<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Modifier categorie</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Modifier categorie</h4>
    <?php
    include 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $sqlState->execute([$id]);
    $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['modifier'])){
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $icone = $_POST['icone'];

    if(!empty($libelle) && !empty($description)){
        $sqlState = $pdo->prepare('UPDATE categorie
                                           SET libelle = ?, 
                                               description = ?,
                                               icone = ?
                                               WHERE id = ?');
        $sqlState->execute([$libelle,$description,$icone,$id]);
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
        <input type="text" class="form-control" name="libelle" value="<?= $categorie['libelle'] ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" > <?= $categorie['description'] ?> </textarea>

        <label class="form-label">Icone</label>
        <input type="text" class="form-control" name="icone" value="<?= $categorie['icone'] ?>">

        <input type="submit" value="Modifier utilisateur" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>