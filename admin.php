<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <?php
    if(!isset($_SESSION['utilisateur'])){
        header('Location: connexion.php');
    }
    ?>
    <h3>Bonjour: <?php echo $_SESSION['utilisateur']['login'] ?></h3>

</div>

</body>
</html>