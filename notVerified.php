
<?php session_start(); include 'head.php';
$email = $_SESSION['email'];
$fullname = $_SESSION['fname'].' '.$_SESSION['lname'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accout Verify</title>
</head>
<style>
    .blod{
        font-weight: bold;
    }
</style>
<body>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Account Not Verified</h4>
  <h5>Dear <span class='blod'><?php echo $fullname ?> </span> your account has not been verified yet, please verify your account by clicking on the verification link sent to your email address.</h5>
 
  <hr>
  <p class="mb-0">Check the spam folder </p>
</div>
</body>
</html>