<!doctype html>
<html lang="en">
<head>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
    <title>Register - Wiki</title>
</head>
<body class="text-center">

<main class="form-signin">
    <form action="index.php?page=register" method="post">
        <img src="assets/img/wiki.png" style="width: 100px; height: 100px" alt="logo">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating">
            <input name="first_name" type="text" class="form-control" id="floatingUsername" placeholder="Username" required>
            <label for="floatingUsername">First name</label>
        </div>

        <div class="form-floating">
            <input name="last_name" type="text" class="form-control" id="floatingUsername" placeholder="Username" required>
            <label for="floatingUsername">Last name</label>
        </div>

        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button name="register" class="w-100 btn btn-lg btn-dark " type="submit">Sign up</button>
        <a href="index.php?page=login" class="w-100 btn btn-lg btn-secondary mt-2" type="button">Sign in</a>
        <a href="index.php?page=home" class="w-100 btn btn-lg btn-outline-dark mt-2" type="button">Back</a>
        <p class="mt-5 mb-3 text-muted">&copy; WIKI/2023–2024</p>
    </form>
</main>
</script>
</body>
</html>
