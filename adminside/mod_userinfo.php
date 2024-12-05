<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
include '../vscode/dbcon.php';


if(isset($_POST['ui-edit-btn'])){ //IF EDITING RECORD
    if (isset($_GET['uiidlabel'])) {
        $userinfo_id = $_GET['uiidlabel'];

        $getnamequery = "SELECT * FROM user_information WHERE userinfo_id = ?";
        $stmt = $con->prepare($getnamequery);
        $stmt->bind_param("s",$userinfo_id);
        if ($stmt->execute()) {
            $results = $stmt->get_result(); // Always return the result object        
            $ui_row = mysqli_fetch_assoc($results);            
            $user_full = $ui_row['firstname'] . ' '.$ui_row['lastname'];
            $user_su = $ui_row['student_number'];
            $user_sex = $ui_row['sex'];
            $user_bday = $ui_row['bday'];
            $user_contact = $ui_row['contact_number'];
            $user_email = $ui_row['email'];
            $acc_stat = $ui_row['account_status'];

        } else {
            echo "Error: " . $stmt->error;
        }
        $isEdit = True;

    }                                     
} else if (isset($_POST['ui-add-btn'])){ //IF NEW RECORD
    $post_id = TableRowCount("user_information",$con)+1;
    $isEdit = False;

}

?>

<!-- CONTENTS -->
<div class="logo-bg-2"></div>
<div class="admin-container">

    <div class="row admin-mod-text">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Modify News and Update Record
                    </h2>
                </div>
                <div class="card-body">
                    <form action="admin_proc.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="post_id" value="<?= $post_id; ?>"> <!-- Pass the category ID -->
                                <?php
                                    // IF EDIT RECORD
                                    if($isEdit){?> 
                                        <input type="hidden" name="init_img"  value="<?=$post_img?>">

                                        <div class="mod-img-preview" align="center">
                                            <img src="record_images/post_images/<?=$post_img?>"  alt="item image">
                                        </div>
                                        <label for="">
                                            Current Post Title
                                        </label>
                                        <input type="text" disabled value="<?= $post_title ?> "name="oldposttitle" placeholder="Enter Post Title" class="form-control" required>
                                        <label for="">
                                            Post Title
                                        </label>
                                        <input type="text" value="<?= $post_title ?>" name="post_title" placeholder="Enter Post Title" class="form-control" required>  
                                        <label for="">
                                            Post Caption
                                        </label>
                                        <textarea name="post_caption" value="<?= $post_caption ?>" id="post_caption" placeholder="Enter Post Caption" class="form-control" required> <?= $post_caption ?></textarea>
                                        
                                        <label for="">
                                            Post URL
                                        </label>
                                        <textarea name="post_url" id="post_url" placeholder="Enter Post URL" class="form-control" required><?= $post_url ?></textarea>                                    
                                        
                                        <label for="">
                                            Post Image
                                        </label>
                                        <input type="file" name="post_img" accept=".jpg,.jpeg,.png,.gif" placeholder="Submit Image File" class="form-control"> 
                                        
                                        <?php

                                    // IF NEW RECORD                                
                                    }else {?>
                                        <label for="">
                                            Post Title
                                        </label>
                                        <input type="text" name="post_title" placeholder="Enter Post Title" class="form-control" required>  
                                        <label for="">
                                            Post Caption
                                        </label>
                                        <textarea name="post_caption" id="post_caption" placeholder="Enter Post Caption" class="form-control" required></textarea>
                                        
                                        <label for="">
                                            Post URL
                                        </label>
                                        <textarea name="post_url" id="post_url" placeholder="Enter Post URL" class="form-control" required></textarea>                                    
                                        <label for="">
                                            Post Image
                                        </label>
                                        <input type="file" name="post_img" accept=".jpg,.jpeg,.png,.gif" placeholder="Submit Image File" class="form-control" required> 
                                        
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="post-label">
                                    Item ID : <?=$post_id?>
                                </label>        
                                <br>
                                <br>
                                <?php 
                                if($isEdit){?> 
                                    <label for="">
                                        Post Status
                                    </label>
                                    <br>
                                    <select class="admin-sel" name="recstat" id="recstat">
                                        <?php
                                        if($post_stat == "Active"){
                                            ?>
                                                <option value="Active">Active</option>
                                                <option value="Removed">Remove</option>
                                            <?php
                                        } else {
                                            ?>
                                                <option value="Removed">Remove</option>
                                                <option value="Active">Active</option>
                                            <?php
                                        }
                                        ?>
                                    
                                    </select>
                                <?php
                                }
                                ?>                            

                            </div>
                            <div>
                                <br>
                                <button type="submit" value="<?= $isEdit ? '1' : '0'; ?>" name="post-confirm-btn">Confirm</button>
                                <button type="submit" name="post-cancel-btn" formnovalidate>Cancel</button>
                            </div>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>







<!-- END OF CONTENTS -->
</div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
<?php
include 'includes/footer.php';

function TableRowCount(string $table, $con)
{
    $query = "SELECT COUNT(*) AS total FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con, $query)) {
        $row = mysqli_fetch_assoc($results);
        $count = $row['total'];
    }

    return $count;
}


?>