# My Project

## How to run?

```bash
# run database using docker compose
docker-compose up -d

# start webserver
php -S localhost:8900 public/index.php
```

## How to check user levels inside your views?

If a user is logging into your application, a session variable isset with the
user level. Check the follwing code for an example implementation.

```php
<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
    </li>
    <?php
    if (isset($_SESSION['login'])) {
    ?>
    <?php
    if ($_SESSION['userLevel'] == 1) {
    ?>
    <li class="nav-item active">
        <a class="nav-link" href="/admin">Admin</a>
    </li>
    <?php } ?>
    <li class="nav-item active">
        <a class="nav-link" href="/logout">Logout</a>
    </li>
    <?php
    }
    ?>
</ul>
```
