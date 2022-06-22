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
  </head>
  <script>
    var statusId;
    $(document).on('click', '.changeStatus', function() {
      statusId = $(this).attr("id");
      $.ajax({
        url: "server.php",
        type: 'POST',
        data: {
          editStatusId: $(this).attr("id")
        },
        dataType: 'text',
        success: function(result) {
          console.log(result);
        },
        error: function() {},
      });

    });
    $(document).on('click', '#updateRole', function() {
      $.ajax({
        url: "server.php",
        type: 'POST',
        data: {
          user_id: statusId,
          selectRole: $("#selectRole").val()
        },
        dataType: 'text',
        success: function(result) {
          console.log(result);

          $("#" + statusId).text($("#selectRole").val());
          if ($("#selectRole").val() == 'user')
            $("#" + statusId).css("background-color", "#F46F25");
          else if ($("#selectRole").val() == 'author')
            $("#" + statusId).css("background-color", "cyan");
          else
            $("#" + statusId).css("background-color", "yellow");
        },
        error: function() {},
      });

    });

    $(document).on('click', '.viewDetails', function() {
      $.ajax({
        url: "server.php",
        type: 'POST',
        data: {
          viewDetailsId: $(this).attr("id")
        },
        dataType: 'text',
        success: function(result) {
          console.log(result);
          window.location = "showPostDetailsAdmin.php";

        },
        error: function() {},
      });

    });
  </script>

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
    <br><br>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class=" mb-3">
              <label for="selectStatus">Change Role</label>
              <select id="selectRole" class="form-control rounded-4" required>
                <option value="user">User</option>
                <option value="author">Author</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="updateRole" data-bs-dismiss="modal">Update</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item" id="Orders">
                <a class="nav-link" href="posts.php">
                  <span data-feather="file"></span>
                  <span>Posts</span>
                </a>
              </li>

              <li class="nav-item" id="Users">
                <a class="nav-link" href="users.php">
                  <span data-feather="users"></span>
                  <span>Users</span>
                </a>
              </li>

            </ul>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">User ID</th>
                  <th scope="col">Email ID</th>
                  <th scope="col">Username</th>

                  <th scope="col">Role</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT *
                       from User order by user_id";

                  $res = $conn->query($sql);

                  $rowss = $res->fetchAll(PDO::FETCH_ASSOC);
                  $total = count($rowss);
                  $limit = 10;
                  if (isset($_GET['page']))
                    $page = $_GET['page'];
                  else
                    $page = 1;
                  $start = ($page - 1) * $limit;
                  $pages = ceil($total / $limit);

                  $sql = "SELECT *
              from User order by user_id LIMIT $start,$limit";

                  $res = $conn->query($sql);

                  $rows = $res->fetchAll(PDO::FETCH_ASSOC);
                  //var_dump($rows);
                  foreach ($rows as $key => $val) {     ?>
                    <tr>
                      <td><?php echo ($val['user_id']); ?></td>
                      <td><?php echo ($val['email']); ?></td>

                      <td><?php echo ($val['username']); ?></td>
                      <?php if ($val['user_type'] == "user") { ?>
                        <td class=""><button class="btn  changeStatus" data-bs-toggle="modal" data-bs-target="#exampleModal" id="<?php echo ($val['user_id']); ?>" style="background-color:#F46F25; width:100%"><?php echo ($val['user_type']); ?></button></td>

                      <?php } else if ($val['user_type'] == "author") { ?>
                        <td class=""><button class="btn changeStatus" data-bs-toggle="modal" data-bs-target="#exampleModal" id="<?php echo ($val['user_id']); ?>" style="background-color:Cyan; width:100%"><?php echo ($val['user_type']); ?></button></td>


                      <?php } else { ?>

                        <td class=""><button class="btn changeStatus" data-bs-toggle="modal" data-bs-target="#exampleModal" id="<?php echo ($val['user_id']); ?>" style="background-color:yellow;width:100%"><?php echo ($val['user_type']); ?></button></td>

                      <?php  } ?>
                    </tr>
                <?php
                  }
                } catch (PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                }
                ?>
              </tbody>
          </div>
          </table>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $pages; $i++) {
                if ($i == $page) { ?>
                  <li class="page-item active"><a class="page-link" href="?page=<?php echo ($i); ?>"><?php echo ($i); ?></a></li>
                <?php    } else { ?>
                  <li class="page-item "><a class="page-link" href="?page=<?php echo ($i); ?>"><?php echo ($i); ?></a></li>

                <?php    } ?>
              <?php } ?>
            </ul>
          </nav>
          <a id="dashboard" href="dashboard.php" class="btn btn-secondary">Go Back To Dashboard</a>
      </div>
      </main>
    </div>
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