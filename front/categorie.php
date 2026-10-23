<?php
include_once '../include/database.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
$sqlState->execute([$id]);
$categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

$sqlState = $pdo->prepare('SELECT * FROM produit WHERE id_categorie = ?');
$sqlState->execute([$id]);
$produits = $sqlState->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Categorie | <?= $categorie['libelle'] ?></title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <h4><i class="<?= $categorie['icone'] ?>"></i><?= $categorie['libelle'] ?></h4>
    <div class="container">
        <div class="row">
            <?php
            foreach ($produits as $produit) {
                ?>
                <div class="card mb-3 col-md-4">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produit['libelle'] ?></h5>
                        <p class="card-text"><?= $produit['prix'] ?></p>
                        <p class="card-text"><small class="text-muted">Ajoute le: <?= date_format(date_create($produit['date_creation']), 'Y/m/d') ?></small></p>
                    </div>
                </div>
            <?php
            }
            if (empty($produits)) {
                ?>
            <div class="alert alert-danger" role="alert">
                Pas de produits pour l'instant
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>