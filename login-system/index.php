<?php if (isset($_GET['error'])): ?>
  <div class="alert alert-danger text-center">
    <?php
      if ($_GET['error'] == "invalid_password") echo "Incorrect password!";
      elseif ($_GET['error'] == "user_not_found") echo "No user found with that email.";
    ?>
  </div>
<?php endif; ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      </head>


      <body>
  <div class="login-container">
    <!-- Left Image Panel (60%) -->
    <div class="login-image"></div>

    <!-- Right Login Panel (40%) Full Height -->
    <div class="login-form-full">
      <h2 class="text-center mb-4">Login</h2>
      <form action="login.php" method="POST" class="form-content">
        <div class="mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" onclick="togglePassword('login-password')">
          <label class="form-check-label">Show Password</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p class="mt-3 text-center">Don't have an account? <a href="register.html">Register</a></p>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
