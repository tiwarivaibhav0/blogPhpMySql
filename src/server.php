<?php
include 'connection.php';
if (isset($_POST['checkEmail'])) {
  $checkEmail = $_POST['checkEmail'];
  $checkUsername = $_POST['checkUsername'];
  try {
    $sql = "SELECT *
                 from User where User.email='$checkEmail'
                ";
    $res = $conn->query($sql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows) > 0) {
      echo ("0");
    } else {
      $sql = "SELECT *
            from User where User.username='$checkUsername'
           ";
      $res = $conn->query($sql);
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      if (count($rows) > 0) {
        echo ("1");
      } else {
        echo ("2");
      }
    }
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['data'])) {
  parse_str(json_decode($_POST['data']), $arr);
  $fname = $arr['fname'];
  $lname = $arr['lname'];
  $email = $arr['email'];
  $username = $arr['username'];
  $mobile = $arr['mobile'];
  $city = $arr['city'];
  $Country = $arr['Country'];
  $password = $arr['password'];
  $img = "https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png";
  try {
    $sql = "INSERT INTO `User` ( `fname`, `lname`, `email`, `username`, `mobile`,`city`,`country`,`pin`,`password`,`user_type`,`picture`) VALUES ('$fname', '$lname', '$email', '$username', '$mobile','$city','$Country','123456','$password','author','$img');";

    $conn->query($sql);
    echo ("Successfully Inserted");
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}


if (isset($_POST['loginEmail'])) {
  $email = $_POST['loginEmail'];
  $password = $_POST['loginPassword'];
  $remember = $_POST['remember'];
  try {
    $sql = "SELECT *
                 from User where User.email='$email'
                 AND User.password='$password'";

    $res = $conn->query($sql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
      $id = $rows[0]["user_id"];
      $_SESSION['user'] = $rows[0]["fname"] . ' ' . $rows[0]["lname"];
      $_SESSION['username'] = $rows[0]["username"];

      $_SESSION['email'] = $rows[0]["email"];
      $_SESSION['role'] = $rows[0]["user_type"];
      if ($rows[0]["user_type"] == 'admin') {
        $_SESSION['admin'] = 1;
      } else
        $_SESSION['admin'] = 0;
      $_SESSION['id'] = $id;

      if ($remember == 1) {
        $cookie_id = $id;
        $cookie_name = $_SESSION['username'];
        $role = $_SESSION['admin'];
        setcookie("id", $cookie_id, time() + (86400 * 30), "/");
        setcookie("name", $cookie_name, time() + (86400 * 30), "/");
        setcookie("role", $role, time() + (86400 * 30), "/");
      }

      try {
        $sql = "SELECT *
                               from request where user_id='$id'
                               ";

        $res = $conn->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {

          $_SESSION['request'] = array();
          $_SESSION['request'] = $rows;
        }
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
      echo ("1");
    } else
      echo ("0");
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['showPosts'])) {
  showPosts($_POST['page']);
}


function showPosts($page)
{
  global $conn;
  try {
    $sql = "SELECT *
      from Post where status='approved'";
    $res = $conn->query($sql);
    $rowss = $res->fetchAll(PDO::FETCH_ASSOC);
    $total = count($rowss);
    $limit = 4;
    $start = ($page - 1) * $limit;
    $pages = ceil($total / $limit);
    $sql = "SELECT *
               from Post where status='approved' order by post_id DESC LIMIT $start,$limit";
    $res = $conn->query($sql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    $txt = '';
    if (count($rows) > 0) {
      foreach ($rows as $val) {
        $txt .= '
          <div class="col-lg-8 col-sm-12  mx-0 my-2 border px-3 py-4"  style="border-radius:25px;background-color:#E7E9EB">
                        <div class="about_img"><img src="uploads/' . $val['image'] . '"></div>
                        <div class="like_icon"><img src="images/like-icon.png"></div>
                        <p class="post_text">Post By :<span class="text-danger">' . $val['username'] . '</span> </p>
                        <h2 class="most_text">' . $val['title'] . '</h2>
                        <p>' . substr($val['details'], 0, 200) . '....................</p>
                        <div class="social_icon_main">
                           <div class="social_icon">
                              <ul>
                                 <li><a href="#"><img src="images/fb-icon.png" alt=""></a></li>
                                 <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                                 <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                              </ul>
                           </div>
                           <div class="read_bt"><a href="#" class="readMore" id="' . $val['post_id'] . '">Read More</a></div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-12">
                     </div>
                     ';
      }
      $txt .= '   <nav aria-label="Page navigation example">
        <ul class="pagination">';
      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page)
          $txt .= ' <li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        else
          $txt .= ' <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
      }
      $txt .= ' </ul>
      </nav>';
      echo $txt;
    } else {
      echo $txt;
    }
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}


if (isset($_POST['showPostDetails'])) {
  $_SESSION['showPostDetails'] = $_POST['showPostDetails'];
  $post_id = $_POST['showPostDetails'];

  showPostDetails($post_id);
}
if (isset($_POST['comment'])) {
  $comment = $_POST['comment'];
  $comment = $conn->quote($comment);

  $post_id = $_POST['post_id'];
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  try {
    $sql = "INSERT INTO `comments` ( `post_id`, `user_id`, `comment`, `replies`, `username`) VALUES ('$post_id', '$id', $comment,0, '$username');";
    $conn->query($sql);
    $sql = "update `Post` set comments=comments+1 where post_id='$post_id'";
    $result = $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  showPostDetails($post_id);
}

if (isset($_POST['commentText'])) {
  $commentText = $_POST['commentText'];
  $id = $_POST['commentId'];
  $commentText = $conn->quote($commentText);
  $sql = "SELECT post_id from comments where comment_id='$id'";
  $result = $conn->query($sql);
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
  $post_id = $rows[0]['post_id'];

  try {
    $sql = "update comments set comment=$commentText where comment_id='$id'";

    $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  showPostDetails($post_id);
}

if (isset($_POST['deleteCommentId'])) {
  $deleteCommentId = $_POST['deleteCommentId'];
  $sql = "SELECT post_id from comments where comment_id='$deleteCommentId'";
  $result = $conn->query($sql);
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
  $post_id = $rows[0]['post_id'];
  try {
    $sql = "delete from comments where comment_id='$deleteCommentId'";

    $result = $conn->query($sql);
    $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  showPostDetails($post_id);
}

function showPostDetails($post_id)
{
  global $conn;
  try {
    $sql = "SELECT *
               from Post where post_id='$post_id'";
    $res = $conn->query($sql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    $txt = '';
    if (count($rows) > 0) {
      foreach ($rows as $val) {
        $txt .= '
          <div class="col-lg-8 col-sm-12 pt-3 pb-3"  style="margin:auto;border-radius:25px;background-color:#E7E9EB;">
                        <div class="about_img"><img src="uploads/' . $val['image'] . '"></div>
                        <div class="like_icon"><img src="images/like-icon.png"></div>
                        <p class="post_text">Post By :<span class="text-danger">' . $val['username'] . '</span>
                        ';
        if (isset($_SESSION['id']))
          if ($val['username'] == $_SESSION['username'] || $_SESSION['admin'] == 1) {

            $txt .= '<span class="btn float-end btn-danger deletePost" id="' . $val['post_id'] . '" style="float:right">Delete</span>';
            $txt .= '<span class="btn float-end btn-primary editPost" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $val['post_id'] . '" style="float:right">Edit</span>';
          }
        $txt .= ' </p>
                        <h2 class="most_text" id="title">' . $val['title'] . '</h2>
                        <p id="content">' . $val['details'] . '.</p>
                        <div class="social_icon_main">
                           <div class="social_icon">
                              <ul>
                                 <li><a href="#"><img src="images/fb-icon.png"></a></li>
                                 <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                                 <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                              </ul>
                           </div>
                        </div><br><br>
                        <div class="post__options float-start border" style="border-radius:25px;background-color:#fff;padding-left:2%;padding-right:2%; ">
                        <input type="text" placeholder="Add a new Comment!" style="border-width:0px;
                        border:none;
                        outline:none;" id="comment" width="100%" height="500px">
                       
                       
                      </div>';
        if (isset($_SESSION['id'])) {
          $txt .= ' 
                        <button class="btn btn-sm btn-primary commentBtn float-start"  id="' . $val['post_id'] . '" style="float:left">Comment</button>                     
                        <br><br><div class="float-start">';
        } else {
          $txt .= '  <br>
                        <a class="btn btn-primary"  href="login.php" id="' . $val['post_id'] . '">Comment</a>                     
                        <br><br><div class="float-start">';
        }
      }
      try {
        $sql = "select * from comments where post_id='$post_id'";

        $result = $conn->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        // echo("Successfully Inserted");
        if (count($rows) > 0) {
          foreach ($rows as $key => $val) {
            $txt .= '<div class="commentText float-start" style="border-radius:25px;">
               
                        <hr><span class="text-white rounded-pill bg-dark h5 px-2">' . $val['username'] . '</span><br><br>
               <textarea  style="border-width:0px; margin-left:10%;
               border:none;
               outline:none;" value="' . $val['comment'] . '" readonly id="' . $val['comment_id'] . '"  name="commentText" rows="3" cols="40" class"textarea">' . $val['comment'] . '</textarea>';
            if (isset($_SESSION['id']))
              if ($val['username'] == $_SESSION['username'] || $_SESSION['admin'] == 1) {
                $txt .= '<br><button class=" text-primary editComment" id="' . $val['comment_id'] . '" style="margin-left:10%; border:none" ><i class="bi bi-pen"></i></button>
                  <button class=" text-danger deleteComment" id="' . $val['comment_id'] . '" style="margin-left:1%; border:none"><i class="bi bi-trash"></i></button>
                  ';
              }
            $txt .= '<br>
              
             </div><br>';
          }
          $txt .= '
                     </div></div></div>';
        }
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
      echo $txt;
    } else {
      echo $txt;
    }
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['editStatusId'])) {
  $_SESSION['editStatusId'] = $_POST['editStatusId'];
}

if (isset($_POST['selectstatus'])) {
  $selectstatus = $_POST['selectstatus'];
  $id = $_SESSION['editStatusId'];
  try {
    $sql = "update Post set status='$selectstatus' where post_id='$id'";

    $result = $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['viewDetailsId'])) {
  $_SESSION['viewDetailsId'] = $_POST['viewDetailsId'];
}

if (isset($_POST['showPostDetailsAdmin'])) {
  $viewDetailsId = $_SESSION['viewDetailsId'];
  showPostDetails($viewDetailsId);
}

if (isset($_POST['deletePostId'])) {
  $deletePostId = $_POST['deletePostId'];

  $post_id = $_SESSION['viewDetailsId'];
  try {
    $sql = "delete from Post where post_id='$deletePostId'";

    $result = $conn->query($sql);
    $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['selectRole'])) {
  $selectRole = $_POST['selectRole'];
  $id = $_POST['user_id'];
  try {
    $sql = "update User set user_type='$selectRole' where user_id='$id'";

    $result = $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}


if (isset($_POST['showMyPosts'])) {
  showMyPosts($_POST['page']);
}


function showMyPosts($page)
{
  global $conn;
  $id = $_SESSION['id'];
  try {
    $sql = "SELECT *
      from Post where user_id='$id'";

    $res = $conn->query($sql);

    $rowss = $res->fetchAll(PDO::FETCH_ASSOC);

    $total = count($rowss);
    $limit = 4;
    $start = ($page - 1) * $limit;
    $pages = ceil($total / $limit);
    $sql = "SELECT *
               from Post where user_id='$id' order by post_id DESC LIMIT $start,$limit";

    $res = $conn->query($sql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    $txt = '';
    if (count($rows) > 0) {

      foreach ($rows as $val) {
        $txt .= '
          <div class="col-lg-8 col-sm-12  mx-0 my-2 border px-3 py-4"  style="border-radius:25px;background-color:#E7E9EB">
                        <div class="about_img"><img src="uploads/' . $val['image'] . '"></div>
                        <div class="like_icon"><img src="images/like-icon.png"></div>
                        <p class="post_text">Post By :<span class="text-danger">' . $val['username'] . '</span> </p>
                        <h2 class="most_text">' . $val['title'] . '</h2>
                        <p>' . substr($val['details'], 0, 200) . '....................</p>
                        <div class="social_icon_main">
                           <div class="social_icon">
                              <ul>
                                 <li><a href="#"><img src="images/fb-icon.png"></a></li>
                                 <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                                 <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                              </ul>
                           </div>
                           <div class="read_bt"><a href="#" class="readMore" id="' . $val['post_id'] . '">Read More</a></div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-12">
                     </div>
                     ';
      }
      $txt .= '   <nav aria-label="Page navigation example">
        <ul class="pagination">';
      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $page)
          $txt .= ' <li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        else
          $txt .= ' <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
      }
      $txt .= ' </ul>
      </nav>';
      echo $txt;
    } else {
      echo $txt;
    }
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

if (isset($_POST['updateTitle'])) {
  $updateTitle = $_POST['updateTitle'];
  $updateTitle = $conn->quote($updateTitle);

  $updateContent = $_POST['updateContent'];
  $updateContent = $conn->quote($updateContent);


  $id = $_SESSION['showPostDetails'];

  try {
    $sql = "update Post set title=$updateTitle,details=$updateContent where post_id='$id'";

    $result = $conn->query($sql);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  showPostDetails($id);
}
