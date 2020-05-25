<?php require __DIR__ . "/../layout/header.php"; ?>

<main role="main" class="container">
    <?php /** @noinspection PhpUndefinedVariableInspection */
    echo "Willkommen " . $username; ?>
  <a href="logout" class="btn btn-primary">Logout</a>
</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
