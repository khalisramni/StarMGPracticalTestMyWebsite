<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo isset($pageTitle) ? $pageTitle : 'PracticalTestMyWebsite'; ?></title>
  
  <!-- Bootstrap Quartz theme CSS -->
  <link href="/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/">My Website</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link <?php if(($pageTitle ?? '') === 'Home') echo 'active'; ?>" href="/home">Home</a></li>
          <li class="nav-item"><a class="nav-link <?php if(($pageTitle ?? '') === 'About Us') echo 'active'; ?>" href="/about">About Us</a></li>
          <li class="nav-item"><a class="nav-link <?php if(($pageTitle ?? '') === 'Privacy Policy') echo 'active'; ?>" href="/privacy">Privacy Policy</a></li>
          <li class="nav-item"><a class="nav-link <?php if(($pageTitle ?? '') === 'Legal') echo 'active'; ?>" href="/legal">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <main class="container mt-5">
