<?php session_start(); ?>
<?php include 'includes/navbar.php'; ?>

<div class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h1 class="card-title text-center mb-5 fw-light fs-5">User Login</h1>
            <?php if(isset($_GET['error'])){ ?>
                <p class="error"></p>
            <?php } ?>
            <form method="post">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-success btn-login text-uppercase fw-bold" name="login" type="submit">Login</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include('includes/connection.php');

  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        echo '<script>
              alert("Email id is required");
            </script>';
    }else if(empty($password)){
        echo '<script>
              alert("Password is required");
            </script>';
    }else{
        $sql = "SELECT * FROM users WHERE email='$email' AND passwd='$password'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['email'] === $email && $row['passwd'] === $password){
                $_SESSION['userId'] = $row['id'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['passwd'];
                $_SESSION['contact'] = $row['contact'];
                $_SESSION['photo'] = $row['photo'];
                echo '<script>
              window.location.replace("http://localhost/Registration-system/myprofile.php");
            </script>';
            }
        }else{
            echo '<script>
              alert("Invalid username or password");
            </script>';
        }
    }
  } ?>