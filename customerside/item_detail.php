<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';


if (isset($_GET['item_id'])) {
    $item_id = intval($_GET['item_id']); // Convert to integer for security

    // Fetch item details from the database
    $query = "SELECT * FROM items i LEFT JOIN categories c ON i.cat_id = c.cat_id WHERE item_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $item_name = $item['item_name'];
            $item_spec = $item['item_spec'];
            $item_desc = $item['item_desc'];
            $item_spec = $item['item_spec'];
            $item_type = $item['item_type'];
            $item_price = $item['item_price'];
            $item_discprice = $item['item_discprice'];
            $item_img = $item['item_img'];
            $item_cat = $item['category_name'];

?>

<div class="product-container">

    <div class="product-txt">
            product-container [eto mismong container na white]

        <div class="back-cont">
            back-cont [idk]
            <form action="customer_proc.php" method="post">
                <input type="hidden" name="item_id" value="<?= $item_id; ?>"> <!-- Pass the category ID -->

         
            <div class="item-top-section">
                    
                <div class="item-detail-image">
                    <img src='../adminside/record_images/item_images/<?=$item['item_img']?>' alt='<?=$item['item_name']?>' class="item-detail-image">
                </div>
                <div class="item-detail-name">
                    <h1><?=$item_name?></h1>
                    <h5>Price: ₱<?=$item_discprice?> — ₱<?=$item_price?></h>
                    <br>
                    <h6><?=$item_spec?></h6>
                    <div>
                        <p>HELLO GRARDEE AKO PO E2 PAPALITAN NALANG PI NG YUNG SA QUANTITY EME NG MGA ECOMMERCE YUNG MAY PLUS AT MINUS SIGN SA MAGKABILANG GILID</p>
                        <input type="number" min="0" step="1" name="quantity" placeholder="quantity" class="form-control" required>
                        
                    </div>
                    <div>
                        <h6>SSITE Member Price : ₱<?=$item_discprice?></h6>
                        <h6>SSITE Non-Member Price : ₱<?=$item_price?></h6>
                    </div>
                </div>
                
            </div>
            <hr> 
            <!-- EDIT NIYO NALANG HR TAG -->
            <div class="item-mid-section">
                <div class="item-description">
                    <p>Description : </p>
                    <p><?=$item_desc?></p>

                </div>
            </div>
                    
            <div class="item-bottom-section">
                    
            
            <br>
                <div class="item-detail-buttons">
                    <button type="submit" name="item-cart-btn" >Add to Cart</button>
                    <button type="submit" name="item-order-btn" >Order Now</button>
                    

                
                </div>
            </div>
            </form>

        </div>

    </div>
</div>





            <?php
        } else {
            echo "<p>Item not found.</p>";
        }
    } else {
        echo "<p>Error fetching item details.</p>";
    }
} else {
    echo "<p>No item selected.</p>";
}
?>
            
