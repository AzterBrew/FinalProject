<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>

<body class="logo-bg-2">
    <div class="home-txt">
    
    <div>
    <div class="list-group">
                <a href="product_display.php" class="list-group-item list-group-item-action">PRODUCTS</a>
                <a href="#" class="list-group-item list-group-item-action">eme</a>
                <a href="#" class="list-group-item list-group-item-action">NEWS & UPDATES</a>
                <a href="#" class="list-group-item list-group-item-action">ADMINISTRATORS</a>
                <a href="#" class="list-group-item list-group-item-action">TRANSACTIONS</a>
                
    <a class="list-group-item list-group-item-action" 
    data-bs-toggle="collapse" 
    href="#collapseAccounts" 
    role="button" 
    aria-expanded="false" 
    aria-controls="collapseAccounts">
        USER ACCOUNT RECORDS
    </a>
    <div class="collapse" id="collapseAccounts">
        <ul class="list-group mt-2">
            <a class="list-group-item list-group-item-action" href="view_userinfo.php">USER INFORMATION</a>
            <a class="list-group-item list-group-item-action" href="view_useracc.php">USER ACCOUNT DETAILS</a>
        </ul>

                
                </div>
    </div>
    </div>
    
<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>