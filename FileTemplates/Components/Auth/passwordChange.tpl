<?php require __DIR__ . "/../layout/header.php"; ?>

<main role="main" class="container">

    <form method="POST" action="/passwordChangeSend" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">
                Passwort:
            </label>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Passwort wiederholen:
            </label>
            <div class="col-md-9">
                <input type="password" name="passwordRepeat" class="form-control"/>
            </div>
        </div>
        <input type="submit" value="Senden" class="btn btn-primary"/>
    </form>

</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
