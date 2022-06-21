<?php
include 'connection.php';
if (isset($_COOKIE['id'])) {
  $_SESSION['username'] = $_COOKIE['name'];
  $_SESSION['admin'] = $_COOKIE['role'];
  $_SESSION['id'] = $_COOKIE['id'];
  header("Location: home.php");
}
if (isset($_SESSION['username']))
  header('location:home.php');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.88.1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="code.js"></script>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    .adjustout {
      margin-left: 3vw;
      margin-bottom: 20vh;
    }
  </style>
  <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <div class="adjustout">
    <div>
      <img class="user__avatar" src="https://revenuearchitects.com/wp-content/uploads/2017/02/Blog_pic.png" alt="" width="300px" />
    </div>
  </div>
  <main class="form-signin">
    <h1 class="h3 mb-3 fw-normal">Login to Read/Post Blog(s)</h1>
    <form class="needs-validation" novalidate action="#" id='Signin'>
      <div class="form-floating">
        <div id="reg">
        </div>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="loginEmail" placeholder="name@example.com" required>
        <label for="loginEmail">Email address</label>
        <div class="invalid-feedback">
          Valid email is required.
        </div>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="loginPassword" placeholder="Password" required>
        <label for="loginPassword">Password</label>
        <div class="invalid-feedback">
          Valid Password is required.
        </div>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" id="remember"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-warning" type="submit">Sign in</button>
    </form>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    <div class="checkbox mb-3">
      <label>
        <span value="remember-me"> Not a user? <a href="index.php">Register</a>
        </span>
      </label>
    </div>
  </main>
</body>

</html>