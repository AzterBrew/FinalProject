<!-- TESTING LANG ITOOOO -->
<!-- TESTING LANG ITOOOO -->
<!-- TESTING LANG ITOOOO -->
<!-- TESTING LANG ITOOOO -->

<?php 


session_start(); 
include '../vscode/dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/SSITE-LOGO.png" type="image/png">
    <title>SSITE | Merchandise Ordering</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . '/../adminside/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . '/../customerside/style.css'; ?>">
    </head>
<body class="logo-bg-2">
<div class="custom-nav">
<?php 
include 'navbar.php'; 
include 'sidebar.php'; 
?>
</div>
            <div class="content">
            <!-- Your content goes here -->
