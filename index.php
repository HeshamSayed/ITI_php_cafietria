<?php
  session_start();
  //print_r($_SESSION);
  $noHeader = '';
  include 'init.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST' )
  {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    //check if user exist in the db
    $stmt = $con->prepare("SELECT * FROM User WHERE email = ?");
    $stmt->execute(array($username));
    while ($row = $stmt->fetch()) {
      if (password_verify($password, $row['password']))
      {
        if($row['group_id'] > 0)
        {
            $_SESSION['User'] = $row;
            header('location:adminPage.php');
            exit();
        }else {
            $_SESSION['User'] = $row;
            header('location:userPage.php');
        }
      }
    }
  }
?>

<!--<form class="login" action="--><?php //echo $_SERVER['PHP_SELF']?><!--" method="POST">-->
<!--<h4 class="text-center">Login</h4>-->
<!--<input class="form-control" type="text" name="user"  placeholder="Enter your name" autocomplete="off" />-->
<!--<input class="form-control" type="password" name="pass"  placeholder="Enter your Password" autocomplete="new-password" />-->
<!--<input class="btn btn-primary btn-block" type="submit" value="login" />-->
<!---->
<!--</form>-->


<section>
  <div class="container">
    <div class="login-form">
      <h1>Sign In</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="user" placeholder="Enter your email" autocomplete="off" />
        <input type="password" name="pass" placeholder="password" autocomplete="new-password" />
        <input type="submit" name="" value="Login">
      </form>
      <a href="ForgetPass.php">Forget Password<a>
    </div>
  </div>
</section>








<?php //include $tpl . 'footer.php';?>