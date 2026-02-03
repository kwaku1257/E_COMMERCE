<?php require_once '../Settings/core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register – Choggy Bags</title>
  <link rel="stylesheet" href="../CSS/register.css">
</head>
<body>

  
  <div class="video-wrapper">
    <video autoplay muted loop class="bg-video">
      <source src="../Videos/ballooncncpt.mp4" type="video/mp4">
      <img src="../Videos/pbags1.jpg" alt="Choggy Bags background" class="fallback-image">
    </video>
  </div>


  <div class="auth-box">
    <h2>Join the Choggy Family!</h2>

    <form id="registerForm" autocomplete="off">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" id="email" placeholder="Email Address" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <input type="password" id="confirm_password" placeholder="Confirm Password" required>
      <input type="text" name="country" placeholder="Country">
      <input type="text" name="city" placeholder="City">
      <input type="text" name="gender"placeholder="Gender">
      <input type="text" name="contact" id="contact" placeholder="Contact (e.g. 024XXXXXXX)" required>
      <input type="hidden" name="role" value="2">
    
      <button type="submit">Register</button>
      

      <p id="form-error" class="error-message" style="display: none;"></p>
      <p id="form-success" class="success-message" style="display: none;"></p>
    </form>

    <div class="login-links">
      <a href="../Login/login.php">Already have an account? Login</a>
    </div>
  </div>

  
  <script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const email = document.getElementById('email').value.trim();
      const phone = document.getElementById('contact').value.trim();
      const password = document.getElementById('password').value;
      const confirm = document.getElementById('confirm_password').value;
      const error = document.getElementById('form-error');
      const success = document.getElementById('form-success');

      
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const phoneRegex = /^(?:\+233|0)[2354][0-9]{8}$/;

      
      if (!emailRegex.test(email)) {
        error.textContent = "Please enter a valid email address.";
        error.style.display = "block";
        success.style.display = "none";
        return;
      }

      if (!phoneRegex.test(phone)) {
        error.textContent = "Please enter a valid Ghanaian phone number.";
        error.style.display = "block";
        success.style.display = "none";
        return;
      }

      if (password !== confirm) {
        error.textContent = "Passwords do not match.";
        error.style.display = "block";
        success.style.display = "none";
        return;
      }

      
      const formData = new FormData(this);

      fetch('../Actions/registerprocess.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'error') {
          error.textContent = data.message;
          error.style.display = "block";
          success.style.display = "none";
        } else {
          success.textContent = data.message;
          success.style.display = "block";
          error.style.display = "none";

           
          setTimeout(() => {
            window.location.href = '../Login/login.php';
          }, 2000);
        }
      })
      .catch(() => {
        error.textContent = "An unexpected error occurred. Please try again.";
        error.style.display = "block";
        success.style.display = "none";
      });
    });
  </script>

</body>
</html>
