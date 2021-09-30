<?php session_start(); ?>
<?php include 'includes/navbar.php'; ?>

<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/img3.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h2 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Register User</h2>

            <form class="px-md-2" method="post" enctype="multipart/form-data">

              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="firstname"/>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="lastname"/>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="form-outline">
                    <input type="email" class="form-control" id="email" name="email" placeholder="xyz@gmai.com"/>
                  </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                    <div class="form-outline">
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="contact"/>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                    <div class="form-outline">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password"/>
                    </div>
                    </div>
                </div>

                <div class="input-group mb-4">
                    <div class="custom-file">
                    <input type="file" class="form-control" id="image" name="image" aria-describedby="inputGroupFileAddon01"  placeholder="profile photo" value="">
                    </div>
                </div>
        
              <button type="submit" class="btn btn-success btn-md mb-1" name="submit">Register</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  include('includes/connection.php');
  $target_dir = "uploads/";


  if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];
        $file = $_FILES['image'];
        
      if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($contact) || empty($file)){
        echo '<script>
        alert("Empty values are not allowed");
      </script>';
      }else{
        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];

        if($fileerror == 0){
          $destfile = 'uploads/'.$filename;
          move_uploaded_file($filepath,$destfile);

          $sql = "insert into users(fname, lname, email, contact, passwd , photo)
          values('".$fname."', '".$lname."', '".$email."', '".$contact."', '".$password."', '".$destfile."')";
			    $result = mysqli_query($conn, $sql);
          if($result){
            echo '<script>
              alert("User Registered Successfully");
              window.location.replace("http://localhost/Registration-system/register.php");
            </script>';
          }
        }
      }  
	}
?>