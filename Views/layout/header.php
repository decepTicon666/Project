<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My Project</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }
        body > .container {
            padding: 60px 15px 0;
        }
        .footer > .container {
            padding-right: 15px;
            padding-left: 15px;
        }
        code {
            font-size: 80%;
        }
    </style>

    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">My Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
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
        </div>
    </nav>
</header>

