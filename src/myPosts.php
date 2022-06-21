<?php
include 'connection.php';
if (isset($_SESSION['user']))
   if ($_SESSION['admin'] == 1)
      header('Location: dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
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
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <?php
   if (isset($_GET['page']))
      $page = $_GET['page'];
   else
      $page = 1;
   ?>
   <script>
      showPosts();

      function showPosts() {
         page = '<?php echo $page; ?>';
         $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
               showMyPosts: "true",
               page: page
            },
            dataType: 'text',
            success: function(result) {
               console.log(result);
               $("#posts").html(result);
            },
            error: function() {},
         });
      }
      $(document).on('click', '.readMore', function(e) {
         // e.preventDefault();
         // alert($(this).attr("id"));
         $.ajax({
            url: "server.php",
            type: 'POST',
            data: {
               showPostDetails: $(this).attr("id")
            },
            dataType: 'text',
            success: function(result) {
               console.log(result);
               $("#detailPost").html(result);
            },
            error: function() {},
         });
      });
      $(document).on('click', '.commentBtn', function(e) {
         //alert($("#comment").val());
         if ($("#comment").val() == '') {
            alert("Oops! can't make an empty comment");
         } else {
            $.ajax({
               url: "server.php",
               type: 'POST',
               data: {
                  comment: $("#comment").val(),
                  post_id: $(this).attr("id")
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
                  window.location = 'home.php';
               },
               error: function() {},
            });
         }
      });
      $(document).on('click', '.editComment', function(e) {
         e.preventDefault();
         if ($(this).text() == "Save") {
            var commentText = $(this).closest("div.commentText").find("textarea[name=commentText]").val();
            if (commentText != '') {
               $.ajax({
                  url: "server.php",
                  type: 'POST',
                  data: {
                     commentText: commentText,
                     commentId: $(this).attr("id")
                  },
                  dataType: 'text',
                  success: function(result) {
                     console.log(result);

                     $("#detailPost").html(result);
                  },
                  error: function() {},
               });

            } else {
               alert("Oops! can't make an empty comment");
            }
         } else {
            var editComment = $(this).attr("id");
            $("#" + editComment).attr("readonly", false);
            $(this).text("Save");
         }
      });
      $(document).on('click', '.deleteComment', function(e) {
         e.preventDefault();

         if (window.confirm("Do you really want to Delete your Comment?")) {
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
      $(document).on('click', '.editPost', function(e) {
         // e.preventDefault();
         alert($("#content").text());

         $("#updateTitle").text($("#title").text());
         $("#updateContent").text($("#content").text());

      });
      $(document).on('click', '#updatePost', function(e) {
         // e.preventDefault();
         var updateTitle = $("#updateTitle").val();
         var updateContent = $("#updateContent").val();
         if (updateTitle == '') {
            alert("Title can't be empty!")
         } else if (updateContent == '') {
            alert("Content can't be empty!")

         } else {
            alert("Post Updated!")

            $.ajax({
               url: "server.php",
               type: 'POST',
               data: {
                  updateTitle: updateTitle,
                  updateContent: updateContent
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
      $(document).on('keyup', '#content', function(e) {
         if ($("#title").val() != '' && $("#content").val() != '') {
            $("#uploadBtn").css("visibility", 'visible');
         } else {
            $("#uploadBtn").css("visibility", 'hidden');
         }
      });
   </script>
</head>

<body>
   <!-- header section start -->
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
                     <a class="nav-link" href="#">About</a>
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
                        <a class="nav-link text-warning" href="myPosts.php"><?php echo ($_SESSION['username']); ?></a>


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
   <br><br>
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class=" mb-3" style="margin:auto ;">
                  <h3>Title</h3>
                  <textarea id="updateTitle" cols=45 rows=2></textarea>
                  <h3>Content</h3>
                  <textarea id="updateContent" cols=45 rows=15></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" id="updatePost" data-bs-dismiss="modal">Update</button>
            </div>
         </div>
      </div>
   </div>
   <div id="detailPost" class="about_section layout_padding">
      <div class="container">
         <div class="touch_setion">
            <div class="box_main">
               <div class="image_2">
                  <!-- <h4 class="who_text active">Who am i</h4> -->
               </div>
            </div>
         </div>
      </div>
      <div class="about_section layout_padding">
         <div class="container">
            <div class="row" id="posts">

            </div>
         </div>

      </div>

   </div>

   <div class="tag_section layout_padding">
      <div class="container">
         <h1 class="tag_taital">Tag</h1>
         <div class="tag_bt">
            <ul>
               <li class="active"><a href="#">Miscellaneous</a></li>
               <li><a href="#">Politics</a></li>
               <li><a href="#">Movies</a></li>
               <li><a href="#">Tourism</a></li>
               <li><a href="#">Sports</a></li>
            </ul>
         </div>
      </div>
   </div>
   <!-- tag section end -->
   <!-- contact section start -->
   <div class="contact_section layout_padding">
      <div class="container">
         <div class="row">

            <div class="col-md-6">
               <?php if (isset($_SESSION['id']))
                  if ($_SESSION['role'] == 'user') {   ?>
                  <div class="mail_section" id="contact">

                     <h4>Currently you are restricted to Post!</h4>
                  </div>

               <?php  } else { ?>
                  <form action="insert.php" method="POST" enctype="multipart/form-data">
                     <div class="mail_section" id="contact">
                        <h1 class="contact_taital">Post a Blog!</h1>
                        <input type="text" class="email_text text-dark fw-bold" placeholder="Post Title!" name="title" id="title">
                        <input type="file" class="email_text" placeholder="choose a file" name="anyfile">
                        <textarea class="massage_text text-dark " placeholder="Write content here!" rows="5" id="content" name="content"></textarea>
                        <div class="send_bt"><button type="submit" class="btn btn-warning" style="visibility:hidden" id="uploadBtn">Upload</button></div>
                     </div>
            </div>

         <?php  } ?>
         </form>

         </div>
      </div>
   </div>
   <!-- contact section end -->
   <!-- footer section start -->
   <div class="footer_section layout_padding">
      <div class="container">
         <div class="footer_logo"><a href="index.php" class="text-white h2">BlogStar.com</a></div>

         <div class="contact_menu">
            <ul>
               <li><a href="#"><img src="images/call-icon.png"></a></li>
               <li><a href="#">Call : 8090000000</a></li>
               <li><a href="blog.html"><img src="images/mail-icon.png"></a></li>
               <li><a href="features.html">Blogstar@gmail.com</a></li>
            </ul>
         </div>
      </div>
   </div>
   <!-- footer section end -->
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">Copyright 2022 All Right Reserved By @BlogStar.com</a></p>
      </div>
   </div>
   <!-- copyright section end -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   <script src="/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
   <script src="dashboard.js"></script>
</body>

</html>