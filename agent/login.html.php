<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">



    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    label {
        padding-top: 15px;

    }

    body {
        background-color: whitesmoke;
    }

    .jumbotron {
        border: solid 4px;
        border-radius: 30px;
    }
    </style>

</head>

<body>
    <div class="row">
        <h1 class="text-center mt-3">Adashe</h1>
    </div>
    <div class="row p-3 mt-3">
        <div class="col-md-6 offset-3">
            <div class="jumbotron br-light border border-5 border-circular border-primary p-5">

                <h1 class="text-center">Log In</h1>
                <?php if (isset($loginError)) : ?>
                <p class="alert text-danger text-center"><?php echo htmlout($loginError); ?></p>
                <?php endif; ?>
                <div class="col-md-8 offset-2">

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input class="form-control border-primary" type="text" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password </label>
                            <input class="form-control border-primary" type="password" name="password" id="password" />
                        </div>
                        <div class="form-group col-md-4 offset-4 mt-3">
                            <input type="hidden" name="action" value="login" />
                            <input class="btn btn-lg btn-success form-control" type="submit" value="Log in" />
                        </div>
                        <p class="text-center mt-4 text-primary">Having problems login in? Contact Systems Administrator! </p>
                    </form>

                </div>


            </div>
        </div>
    </div>


</body>

</html>                          