<?php require __DIR__ . "/../layout/header.php"; ?>

<main role="main" class="container">
    <h1>Admin Page</h1>
    <?php

    /** @noinspection PhpUndefinedVariableInspection */
    if ($isAdmin) {
        echo 'Du bist ein Admin!';
    } else {
        echo 'Dir fehlen die Admin Rechte!';
    }

    ?>
</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
