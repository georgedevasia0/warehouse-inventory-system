<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
</head>
<body style="background-color:#F1F2F7;">
  <div class="container" style="max-width:500px;background-color:white;border-radius:10px;padding:35px;margin-top:100px">
      <div class="text-center">
         <h1 style="font-weight:700;color:#FF7857">Welcome</h1>
         <p>Sign in to start your session</p>
       </div>
       <?php echo display_msg($msg); ?>
        <form method="post" action="auth.php" class="clearfix">
          <div class="form-group">
                <label for="username" class="control-label">Username</label>
                <input type="name" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="form-group">
              <label for="Password" class="control-label">Password</label>
              <input type="password" name= "password" class="form-control" placeholder="password">
          </div>
          <div class="form-group">
                  <button type="submit" class="btn btn-info  form-control">Login</button>
          </div>
      </form>
  </div>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>
