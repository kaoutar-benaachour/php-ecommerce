<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <title>Liste des produits</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h2>Liste des produits</h2>
    <a href="ajouter_produit.php" class="btn btn-success">Ajouter produit</a>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>prix</th>
            <th>Discount</th>
            <th>Categorie</th>
            <th>Date</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $produits = $pdo->query('
    SELECT produit.*, categorie.libelle AS categorie_libelle
    FROM produit
    INNER JOIN categorie
        ON produit.id_categorie = categorie.id
')->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['supprimer'])) {
            $id = $_POST['id'];
            $sqlState = $pdo->prepare("DELETE FROM produit WHERE id=?");
            $sqlState->execute([$id]);
        }

        foreach ($produits as $produit) {
            $prix = $produit['prix'];
            $discount = $produit['discount'];
            $prixF = $prix - (($prix * $discount) / 100);
            ?>
            <tr>
                <td><?= $produit['id'] ?></td>
                <td><?= $produit['libelle'] ?></td>
                <td><?= $produit['prix'] ?>MAD</td>
                <td><?= $produit['discount'] ?>%</td>
                <td><?= $produit['categorie_libelle'] ?></td>
                <td><?= $produit['date_creation'] ?></td>
                <td>
                    <a href="modifier_produit.php?id=<?= $produit['id'] ?>" class="btn btn-primary">Modifier</a>
                    <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" onclick="return confirm('voulez vous vraiment supprimer la categorie <?= $categorie['libelle'] ?>')"
                       class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
</div>

</body>
</html>