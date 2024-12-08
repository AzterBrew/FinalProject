<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

$userinfo_id = $_SESSION['uid'];

// Fetch item details from the database
$cartquery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id WHERE ui.userinfo_id = ?";
$stmt = $con->prepare($cartquery);
$stmt->bind_param("i", $userinfo_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Loop through the items and display them
    }
}
?>
<body class="logo-bg-2">
    <div class="product-container">
        <div class="product-txt">
            <div class="back-cont">
                <div>
                    <h1>Your Cart</h1>
                    <hr>
                </div>

                <div class="display-cont">
                    <div class="cart-cont">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($item = $result->fetch_assoc()) {
                                $item_name = $item['item_name'];
                                $quant = $item['quantity'];
                                $item_price = $item['item_price'];
                                $item_img = $item['item_img'];
                        ?>

                        <form action="customer_proc.php" method="post" class="form-cart">
                            <input type="hidden" name="item_id" value="<?= $item['item_id']; ?>"> <!-- Pass the item ID -->

                            <div class="item-top-section">
                                <div class="item-detail-image">
                                    <img src="../adminside/record_images/item_images/<?=$item_img?>" alt="<?=$item_name?>" class="item-detail-image">
                                </div>

                                <div class="item-detail-name">
                                    <a href="">
                                    <h1><?=$item_name?></h1>

                                    </a>
                                    <?php
                                    if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){ //NON MEMBER
                                                ?>
                                                 <h6>Price: ₱<?=$item_price?></h6>

<?php
                                            } else if($item['memstatus_id']==2) { ?> //NON MEMBER
                                                <h6>Price: ₱<?=$item_discprice?></h6>
                                                
<?php
                                            }
                                        ?>

                                    <br>
                                    <h6><?=$item_spec?></h6>
                                    <div>
                                        <label for="quantity">Quantity:</label>
                                        <input value="<?=$quant?>" type="number" min="1" step="1" name="quantity" placeholder="Quantity" class="form-control" required>
                                    </div>
                                    <div>
                                        <?php
                                            if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){ //NON MEMBER
                                                ?>
                                                 <h6>SSITE Non-Member Price: ₱<?=$item_price?></h6>

<?php
                                            } else if($item['memstatus_id']==2) { ?> //NON MEMBER
                                                <h6>SSITE Member Price: ₱<?=$item_discprice?></h6>
                                                
<?php
                                            }
                                        ?>
                                    </div>
                                    <div class="item-description">
                                        <p>Description:</p>
                                        <p><?=$item_desc?></p>
                                    </div>
                                    <button class="buy-btn" name="item-order-btn">
                                        Buy Now
                                    </button>

                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        } else {
                            echo "<p>Your cart is empty.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- inline style conflict daw  -->

<style>
    .display-cont li {
        display: inline-block;
    }

    .display-item{
        display: inline-block;
        background-color: #dff;
        border-radius: 5px;
        padding: 15px;
        margin: 5%;
    }

    .item-image {
        width: 7em;
        height: 7em;
        max-width: 7em;
        max-height: 7em;
    }
</style>    


<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>