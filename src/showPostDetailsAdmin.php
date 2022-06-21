<?php
include 'connection.php';
if (!isset($_SESSION['user']) || $_SESSION['admin'] == 0) {
?>
   <p>ACCESS DENIED!</p>
<?php } else { ?>
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
   </style>

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="generator" content="Hugo 0.88.1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Blog.Com</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesoeet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
      <link href="dashboard.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script>
         showPostDetailsAdmin();

         function showPostDetailsAdmin() {
            $.ajax({
               url: "server.php",
               type: 'POST',
               data: {
                  showPostDetailsAdmin: "true"
               },
               dataType: 'text',
               success: function(result) {
                  $("#detailPost").html(result);
               },
               error: function() {},
            });
         }
         $(document).on('click', '.deletePost', function() {
            //  alert()
            if (window.confirm("Do you really want to Delete this Post?")) {
               $.ajax({
                  url: "server.php",
                  type: 'POST',
                  data: {
                     deletePostId: $(this).attr("id")
                  },
                  dataType: 'text',
                  success: function(result) {
                     window.location = 'posts.php';
                  },
                  error: function() {},
               });
            }

         });
         $(document).on('click', '.deleteComment', function(e) {
            e.preventDefault();

            if (window.confirm("Do you really want to Delete this Comment?")) {
               $.ajax({
                  url: "server.php",
                  type: 'POST',
                  data: {
                     deleteCommentId: $(this).attr("id")
                  },
                  dataType: 'text',
                  success: function(result) {
                     console.log(result);
                     $("#detailPost").html(result);

                  },
                  error: function() {},
               });
            }
         });
      </script>

   </head>

   <body>
      <div class="header_section">
         <div class="container-fluid header_main">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="logo" href="index.php"><img src="https://revenuearchitects.com/wp-content/uploads/2017/02/Blog_pic.png" height="80%" width="30%"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse " id="navbarSupportedContent" style="justify-content:end">
                  <ul class="navbar-nav mr-auto justify-content-end">
                     <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#contact">Post Blog</a>
                     </li>
                     <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['username'])) { ?>
                           <a class="nav-link" href="login.php">Login</a>

                        <?php
                        } else { ?>
                           <a class="nav-link text-warning" href="#"><?php echo ($_SESSION['username']); ?></a>
                        <?php }
                        if (isset($_SESSION['username'])) {   ?>
                     <li class="nav-item">
                        <a href="logout.php" class="nav-link btn btn-lg text-danger">
                           <span class="glyphicon glyphicon-log-out "></span> Logout
                        </a>
                     </li>
                  <?php  }
                  ?>
                  </li>

                  </ul>
               </div>
            </nav>
         </div>

      </div>
      <div id="detailPost" class="about_section layout_padding">

      </div>



      <script src="/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="dashboard.js"></script>
   </body>

   </html>

<?php }
?>