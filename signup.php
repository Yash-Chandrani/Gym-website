<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup-Fanatic Fitness</title>
    <!-- <link rel="stylesheet" href="login.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</head>
<body>
    <form id='register-form' action="signup.php" method='post'>
        <input type="text" placeholder="Username" name="name" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <input style="margin-bottom:5% ;" type="password" placeholder="Re Password" required>
        
        <!-- <div class="input-group mb-3">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="plan">Dropdown</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Basic</a></li>
            <li><a class="dropdown-item" href="#">Premium</a></li>
            <li><a class="dropdown-item" href="#">Pro</a></li>
          </ul>
        </div> -->
        <div class="form-check">
          <input class="form-check-input" type="radio" name="plan" id="exampleRadios1" value="Basic">
          <label class="form-check-label" for="exampleRadios1">
            Basic
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="plan" id="exampleRadios2" value="Premium" checked>
          <label class="form-check-label" for="exampleRadios2">
            Premium
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="plan" id="exampleRadios3" value="Pro">
          <label class="form-check-label" for="exampleRadios3">
            Pro
          </label>
        </div>
        <div class="form-outline" style="padding-top:10px;">
          <input type="number" id="typeNumber" class="form-control" name="duration" />
          <label class="form-label" for="typeNumber">Duration</label>
        </div>
        <br>
        <br>
        <!-- <div class="razorpay-embed-btn" data-url="https://pages.razorpay.com/pl_IBegunIvKLzlAq/view" data-text="Pay Now" data-color="#528FF0" data-size="medium">
        <script>
          (function(){
            var d=document; var x=!d.getElementById('razorpay-embed-btn-js')
            if(x){ var s=d.createElement('script'); s.defer=!0;s.id='razorpay-embed-btn-js';
            s.src='https://cdn.razorpay.com/static/embed_btn/bundle.js';d.body.appendChild(s);} else{var rzp=window['__rzp__'];
            rzp && rzp.init && rzp.init()}})();
        </script>
      </div> -->
          
      
</body>
</html>


<?php

function showAlert($type, $msg)
{
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show mb-0" role="alert">
                     ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
// $server="localhost";
// $server="127.0.0.1";

$insert = false;

if (isset($_POST['name'])) {

    require "_database.php";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password1 = $_POST['password'];
    #password 2: reminder
    $hash_pass = password_hash($password1, PASSWORD_DEFAULT);
    $plan = $_POST['plan'];
    $duration = $_POST['duration'];
    $sql = "INSERT INTO `members` (`name`, `email`, `password`, `plan`, `duration`) VALUES ('$name', '$email', '$hash_pass', '$plan', '$duration');";
    // echo $sql;

    if ($con->query($sql) == true) {
        // echo "Successfully inserted";
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $con->error";
    }

    if ($insert == true) {
        // echo "<p>Thank you for enrolling. We hope to see your goals achieved!!</p>";
        
        header('Location: https://rzp.io/l/4o0B0NAq');
    }


    $con->close();
    include 'login_form.html';
}
