<?php require __DIR__ . "/../layout/header.php"; ?>

<main role="main" class="container">

    <?php
    /** @noinspection PhpUndefinedVariableInspection */
    if ($resetTokenSent) {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Bitte prüfe deine Email Adresse und klicke auf den gesendeten Link, um dein Passwort zurück zu setzen.';
        echo '</div>';
    } else {
    ?>

    <form method="POST" action="/passwordReset" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">
                Email:
            </label>
            <div class="col-md-9">
                <input type="email" name="email" class="form-control" />
            </div>
        </div>
        <input type="submit" value="Senden" class="btn btn-primary" />
    </form>

    <?php
    }
    ?>

</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
