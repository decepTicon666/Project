<?php require __DIR__."/../layout/header.php"; ?>

<main role="main" class="container">

    <?php
    /** @noinspection PhpUndefinedVariableInspection */
    if ($registerSuccess) {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Registrierung erfolgreich';
        echo '</div>';
    } else {
        if (!empty($errors))
        {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    ?>

    <form method="post" action="/register" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">
                Vorname:
            </label>
            <div class="col-md-9">
                <input type="text" name="surname" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Nachname:
            </label>
            <div class="col-md-9">
                <input type="text" name="lastname" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Adresse:
            </label>
            <div class="col-md-9">
                <input type="text" name="street" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Hausnummer:
            </label>
            <div class="col-md-9">
                <input type="text" name="number" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Adresse/Zusatz:
            </label>
            <div class="col-md-9">
                <input type="text" name="adress" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Postleitzahl:
            </label>
            <div class="col-md-9">
                <input type="text" name="zipCode" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Stadt:
            </label>
            <div class="col-md-9">
                <input type="text" name="city" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Land:
            </label>
            <div class="col-md-9">
                <input type="text" name="country" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Telefonnummer:
            </label>
            <div class="col-md-9">
                <input type="text" name="phone" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                E-mail Adresse:
            </label>
            <div class="col-md-9">
                <input type="text" name="email" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Benutzername:
            </label>
            <div class="col-md-9">
                <input type="text" name="username" class="form-control"  autocomplete="new-password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                Passwort:
            </label>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control"  autocomplete="new-password"/>
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
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>

    <?php
    }
    ?>

</main>

<?php require __DIR__."/../layout/footer.php"; ?>
