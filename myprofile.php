<?php session_start(); ?>
<?php include 'includes/navbar.php'; ?>
<?php include('includes/connection.php');
$target_dir = "uploads/";

if(isset($_POST['updateProfile'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $file = $_FILES['image'];
        
    $filename = $file['name'];
    $filepath = $file['tmp_name'];
    $fileerror = $file['error'];

        if($fileerror == 0){
          $destfile = 'uploads/'.$filename;
          move_uploaded_file($filepath,$destfile);

          $sql = "UPDATE users SET `fname`='$fname',`lname`='$lname',`email`='$email',`contact`='$contact',`photo`='$destfile'";
          if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Profile Updated you need to login again");</script>';
            include('logout.php');
          } else {
            echo '<script>alert("Failed to update profile");</script>';
          }
        }
}


if(isset($_POST['updatePass'])){
    $currentPass = $_POST['cPassword'];
    $newPass = $_POST['nPassword'];
    $confirm = $_POST['nRPassword'];

    if(empty($currentPass) || empty($newPass) || empty($confirm)){
        echo '<script>
            alert("Empty values are not accepted");
        </script>';
    }
    if(strcmp($newPass, $confirm) !== 0){
        echo '<script>
            alert("Password did not match");
        </script>';
    }else{
            if($_SESSION['password'] === $currentPass){
               $id = $_SESSION['userId'];
               $stmt = "UPDATE `users` SET `passwd`='$newPass' WHERE `id`='$id'";
               if (mysqli_query($conn, $stmt)) {
                echo '<script>alert("Password changed you will need to login again");</script>';
              } else {
                echo '<script>alert("Failed to update password");</script>';
              }
              include('logout.php');
            }
        }
    }


?>


<div class="row m-2">
    <div class="col-md-6">
        <div class="wrapper mt-sm-5" style=" background-color: aliceblue;
    padding: 30px 50px;
    margin: 10px auto;
    max-width: 600px;
    border-radius : 15px;">
            <form method="post" enctype="multipart/form-data">
                <h4 class="pb-4 border-bottom">Account settings</h4>
                <div class="py-2">
                    <div class="container text-center">
                        <img src="<?php echo $_SESSION['photo'];?>" width="100" height="100">
                    </div>
                    <div>
                        <label for="username">Email</label>
                        <input type="email" name="email"
                            class="bg-light form-control "
                            value="<?php echo $_SESSION['email']?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">First Name</label>
                            <input type="text"
                                class="bg-light form-control"
                                name="fname" value="<?php echo $_SESSION['fname']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Last Name</label>
                            <input type="text"
                                class="bg-light form-control"
                                name="lname" value="<?php echo $_SESSION['lname']?>">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="phone">Contact Number</label>
                            <input type="tel"
                                class="bg-light form-control"
                                name="contact" value="<?php echo $_SESSION['contact']?>">
                        </div>
                        <div class="col-md-5 mt-4">
                            <div class="custom-file">
                                <input type="file" class="form-control" id="image" name="image" aria-describedby="inputGroupFileAddon01"  placeholder="profile photo" value="">
                            </div>
                        </div>
                    </div>
                    <div class="py-3 pb-4 border-bottom">
                        <button type="submit" name="updateProfile" class="btn btn-primary mr-3">Update Profile</button>
                        <a href="" class="btn border button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="wrapper mt-sm-5" style=" background-color: aliceblue;
    padding: 30px 50px;
    margin: 10px auto;
    max-width: 600px;
    border-radius : 15px;">
            <form action="" method="POST">
                <h4 class="pb-4 border-bottom">Password</h4>
                <div class="py-2">
                    <div>
                        <input type="password"
                            class="bg-light form-control mb-2"
                            name="cPassword" placeholder="Current Password" value="">
                    </div>
                    <div>
                        <input type="password"
                            class="bg-light form-control mb-2 "
                            name="nPassword" placeholder="New Password" value="">
                    </div>
                    <div>
                        <input type="password"
                            class="bg-light form-control mb-2"
                            name="nRPassword" placeholder="Confirm Password"
                            value="">
                    </div>
                </div>
                    <div class="py-3 pb-4 border-bottom">
                        <button type="submit" name="updatePass" class="btn btn-primary mr-3 mb-2">Update Password</button>
                        <a href="" class="btn border button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

