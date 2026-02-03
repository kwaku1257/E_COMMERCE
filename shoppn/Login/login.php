<?php
require_once '../Settings/core.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – Choggy Bags</title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

  
  <div class="video-wrapper">
    <video autoplay muted loop class="bg-video">
      <source src="../Videos/people_bags.mp4" type="video/mp4">
      <img src="../Videos/pbags1.jpg" alt="Choggy Bags background" class="fallback-image">
    </video>
  </div>

  
  <div class="login-box">
    <h2>WELCOME BACK!</h2>
    <form method="post" action="../Actions/loginprocess.php" autocomplete="off">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <div class="login-links">
      <a href="#">Forgot your password?</a>
    </div>

    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
        echo "<p class='error-message'>Invalid email or password.</p>";
    }
    if (isset($_GET['success'])) {
        echo "<p class='success-message'>Registration successful! Please log in.</p>";
    }
    ?>

    <div class="signup-redirect">
      <p>Don't have an account? <a href="../Login/register.php">Create one</a></p>
    </div>
  </div>

</body>
</html>
