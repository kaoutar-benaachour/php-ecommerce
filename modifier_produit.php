<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Modifier produit</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Modifier produit</h4>
    <?php
    include 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('SELECT produit.*, categorie.libelle 
                                    AS categorie_libelle
                                FROM produit 
                                INNER JOIN categorie
                                    ON produit.id_categorie = categorie.id
                                    WHERE produit.id = ?
                               ');
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC);

    $categories = $pdo->query(
            'SELECT * FROM categorie'
    )->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['modifier'])){
    $libelle = $_POST['libelle'];
    $prix = $_POST['prix'];
    $discount = $_POST['discount'];
    $categorie = $_POST['id_categorie'];

    if(!empty($libelle) && !empty($prix) && !empty($categorie)){
        $sqlState1 = $pdo->prepare('UPDATE produit
                                           SET libelle = ?, 
                                               prix = ?, 
                                               discount = ?,
                                               id_categorie = ?
                                               WHERE id = ?');
        $sqlState1->execute([$libelle,$prix,$discount,$categorie,$id]);
        header('Location: produits.php');
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
        <input type="text" class="form-control" name="libelle" value="<?= $produit['libelle'] ?>">

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" min="0" step="0.1" name="prix" value="<?= $produit['prix'] ?>">

        <label class="form-label">Discount</label>
        <!-- value="" is the default value -->
        <input type="number" class="form-control" min="0" max="90" name="discount" value="<?= $produit['discount'] ?>">

        <label class="form-label">Categorie</label>

        <label class="form-label">Categorie</label>
        <select name="id_categorie" class="form-control">
            <?php
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $categorie) {
                ?>
                <option
                        value="<?= $categorie['id'] ?>"
                        <?= $categorie['id'] == $produit['id_categorie'] ? 'selected' : '' ?>>
                    <?= $categorie['libelle'] ?>
                </option>
                <?php
            }
            ?>
        </select>




        <input type="submit" value="Modifier produit" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>