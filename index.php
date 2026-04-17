<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyDrive - Home</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
  <style>
    body {
      background: url('images/cloud.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .glass {
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 30px;
      color: #fff;
    }
    .hero {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 50px;
      color: #fff;
    }
    .feature-item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .feature-item i {
      font-size: 2rem;
      margin-right: 15px;
    }
    footer {
      background: rgba(0,0,0,0.8);
    }
  </style>
</head>
<body>
<script src="js/signup.js"></script>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="index.php">MyDrive</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link text-white active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#about">About Us</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#contact">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="login.php">Sign in</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-text">
      <h1 class="fw-bold">Store & Access Files Anywhere</h1>
      <p class="lead">MyDrive gives you secure, fast and flexible cloud storage.</p>
      <a href="#signup" class="btn btn-lg btn-info mt-3">Get Started</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="container my-5 text-white">
    <h2 class="text-center mb-4">Why Choose MyDrive?</h2>
    <div class="glass">
      <div class="feature-item"><i class="fas fa-lock text-info"></i><span>Secure Storage with encryption</span></div>
      <div class="feature-item"><i class="fas fa-upload text-success"></i><span>Easy Uploads anytime</span></div>
      <div class="feature-item"><i class="fas fa-credit-card text-warning"></i><span>Flexible Plans for everyone</span></div>
      <div class="feature-item"><i class="fas fa-user-shield text-danger"></i><span>Admin Control & monitoring</span></div>
    </div>
  </section>

  <!-- About Us -->
  <section class="container my-5" id="about">
    <div class="glass text-center">
      <h2>About Us</h2>
      <p>We are building the next generation of cloud storage — secure, fast, and examiner‑ready presentation for your projects.</p>
    </div>
  </section>

  <!-- Contact Us -->
  <section class="container my-5" id="contact">
    <div class="glass">
      <h2 class="text-center mb-4">Contact Us</h2>
      <div class="row">
        <div class="col-md-6">
          <form id="contactForm">
            <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Your Email" required>
            <textarea name="message" class="form-control mb-3" rows="4" placeholder="Message" required></textarea>
            <button class="btn btn-light w-100">Send Message</button>
            <div class="contact_msg mt-3"></div>
          </form>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
          <div>
            <p><i class="fas fa-envelope"></i> support@mydrive.com</p>
            <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            <p><i class="fas fa-map-marker-alt"></i> Patna, Bihar, India</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Signup Section -->
  <div class="container my-5" id="signup">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="images/cloud_img.png" alt="Signup Illustration" class="img-fluid rounded shadow" style="max-height:450px;">
      </div>
      <div class="col-md-6">
        <form class="bg-white rounded shadow-lg p-5 signup-formm">
          <h2 class="text-center mb-4">Create Your Account</h2>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" required />
          </div>
          <div class="mb-3 email_con">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" required />
            <i class="fa fa-circle-notch fa-spin email_loader d-none"></i>
          </div>
          <div class="mb-3 pass_con">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" required />
            <i class="fa fa-eye pass_icon" style="cursor:pointer;"></i>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <small>Click Generate for strong password</small>
            <button class="btn btn-sm btn-danger pass-gen">Generate</button>
          </div>
          <button class="btn btn-success w-100 register_btn" disabled>Register Now!</button>
          <div class="msg mt-3"></div>
        </form>

        <!-- Activation Form -->
        <form class="bg-white rounded shadow-lg p-5 activation-form d-none mt-4" autocomplete="off">
          <h2 class="text-center mb-4">Activate Your Account</h2>
          <div class="mb-3">
            <label for="activation_code" class="form-label">Activation Code</label>
            <input type="text" id="activation_code" class="form-control" required />
          </div>
          <button class="btn btn-primary w-100 activation_btn">Activate Now!</button>
          <div class="activation_msg mt-3"></div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-white text-center p-3 mt-5">
    <p>&copy; 2026 MyDrive | <a href="php/admin/admin_login.php" class="text-warning">Admin Login</a></p>
  </footer>

<script>
$(document).ready(function(){
    // Contact Us form AJAX
    $("#contactForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"php/contact.php",
            data:$(this).serialize(),
            success:function(response){
                if(response.trim()=="success"){
                    $(".contact_msg").html('<div class="alert alert-success mt-3">Message sent successfully!</div>');
                } else {
                    $(".contact_msg").html('<div class="alert alert-danger mt-3">Error sending message.</div>');
                }
                setTimeout(function(){
                    $(".contact_msg").html("");
                    $("#contactForm")[0].reset();
                },3000);
            }
        });
    });
});
</script>
</body>
</html