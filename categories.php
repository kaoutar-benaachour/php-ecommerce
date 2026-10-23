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
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h2>Liste des categories</h2>
    <a href="ajouter_categorie.php" class="btn btn-success">Ajouter categorie</a>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Description</th>
            <th>Icone</th>
            <th>Date</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $categorie) {
            ?>
            <tr>
                <td><?= $categorie['id'] ?></td>
                <td><?= $categorie['libelle'] ?></td>
                <td><?= $categorie['description'] ?></td>
                <td><i class="<?= $categorie['icone'] ?>"></i></td>
                <td><?= $categorie['date_creation'] ?></td>
                <td>
                    <!-- '?' is for working with GET -->
                    <a href="modifier_categorie.php?id=<?= $categorie['id'] ?>" class="btn btn-primary">Modifier</a>
                    <a href="supprimer_categorie.php?id=<?= $categorie['id'] ?>"
                       onclick="return confirm('voulez vous vraiment supprimer la categorie <?= $categorie['libelle'] ?>')"
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