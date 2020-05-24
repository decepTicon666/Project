<?php require __DIR__ . "/../layout/header.php"; ?>

<main role="main" class="container">
    <?php
    /** @noinspection PhpUndefinedVariableInspection */
    if ($isLoggedin) {
        echo '<span>Du bist eingeloggt</span>';
    } else {
        echo '<a href="/login" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Login</a>';
    }
    ?>
</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
