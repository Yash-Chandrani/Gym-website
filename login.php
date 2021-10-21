<?php

function showAlert($type, $msg)
{
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show mb-0" role="alert">
                     ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

if (isset($_POST['l_email']) && isset($_POST['l_password'])) 
{


        $server = "127.0.0.1:3307";
        $username = "root";
        $password = "";
        $db = "gym_site";
        $con = mysqli_connect($server, $username, $password, $db);
    
        if (!$con) {
            die("connection to database failed due to" . mysqli_connect_error());
        }
        // echo "Success connection to the database";
    
        
        $email = $_POST['l_email'];
        $pass = $_POST['l_password'];
    
    $sql = "SELECT * FROM `members` WHERE email='$email';";
    $result = $con->query($sql);
    $num_rows = mysqli_num_rows($result);

    
    // if (password_verify('rasmuslerdorf', $hash)) {
    //     echo 'Password is valid!';
    // } else {
    //     echo 'Invalid password.';
    // }


    if ($num_rows != 0) {
        while ($curr_row = $result->fetch_assoc()) {
            $hash_pass = $curr_row['password'];
            if (password_verify($pass, $hash_pass))
            {
                showAlert("success", "Login Successful! Please wait while we redirect you to your account");
                $login = true;
                
                session_start();
                $_SESSION['name'] = $curr_row['name'];
                $_SESSION['email'] = $email;
                $_SESSION['loggedin'] = true;

                sleep(1);
                header('Location: index.html');

            } else {
                showAlert("danger", "Login failed!");
            }
        }
    } 
    else {
        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                     Email or Password incorrect. Please recheck.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>
