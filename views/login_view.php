<!doctype html>
<html lang="en">
<head>
<!--    --><?php //include_once 'includes/header.php' ?>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="./assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin">
    <form action="index.php?page=login" method="post">
<!--        <img class="mb-4" src="assets/avito-logo.svg" alt="" width="280" height="100" >-->
        <img src="./assets/css/wiki.png" style="width: 100px; height: 100px" alt="hahh">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-secondary" type="submit">Sign in</button>
        <a href="index.php?page=register" class="w-100 btn btn-lg btn-dark mt-2" type="button">Sign up</a>
        <p class="mt-5 mb-3 text-muted">&copy; WIKI/2023–2024</p>
    </form>
</main>

</body>
</html>
