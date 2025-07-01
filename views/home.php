<?php 
$pageTitle = 'Home';
include __DIR__ . '/common/header.php';
require_once 'config.php'; // where your DB config and connection is
$phpVersion = phpversion();
$mysqlVersion = '9.3.0';
$nginxVersion = '1.24.0';
$OSVersion = 'MacOSon15.2 arm64';
?>

<h1>Welcome to the Home Page</h1>
<p>This is a sample 4-page PHP website with privacy consent modal.</p>
<hr>
  <p><strong>Dev Environment:</strong></p>
  <ul>
    <li>PHP Version: <?= $phpVersion ?></li>
    <li>MySQL Version: <?= $mysqlVersion ?></li>
    <li>Nginx Version: <?= $nginxVersion ?></li>
    <li>OS Version: <?= $OSVersion ?></li>
  </ul>
<?php 
include __DIR__ . '/common/consent_modal.php';
include __DIR__ . '/common/footer.php'; 
?>
