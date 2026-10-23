<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Ajouter produit</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Ajouter produit</h4>
    <?php
    require_once 'include/database.php';
    //“Is ajouter set in the POST data?” isset= is set?
    if (isset($_POST['ajouter'])) {
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $idCategorie = $_POST['idCategorie'];

        var_dump($libelle, $prix, $idCategorie);

        if (!empty($libelle) && !empty($prix) && !empty($idCategorie)) {
            $sqlState = $pdo->prepare('INSERT INTO produit(libelle, prix, discount, id_categorie) VALUES(?,?,?,?)');
            $sqlState->execute([$libelle, $prix, $discount, $idCategorie]);
            header('Location: produits.php');
        } else {
            ?>
            <div class="alert theme-danger" role="alert">
                <p>libelle, prix, et categorie sont obligatoires</p>
            </div>
            <?php
        }
    }
    ?>
    <form method="post">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle">

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" min="0" step="0.1" name="prix">

        <label class="form-label">Discount</label>
        <!-- value="" is the default value -->
        <input type="number" value="0" class="form-control" min="0" max="90" name="discount">

        <label class="form-label">Categorie</label>
        <?php
        //using query() when where not getting values from user
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
        ?>
        <select class="form-control" name="idCategorie">
            <option value="">Choisissez une categorie</option>
            <?php
            // <?php echo = <?=
            foreach ($categories as $categorie) {
                echo '<option value="' . $categorie->id . '">' . $categorie->libelle . '</option>';}
                ?>
        </select>

        <input type="submit" value="Ajouter produit" class="btn btn-primary my-2" name="ajouter">
    </form>
</div>

</body>
</html>