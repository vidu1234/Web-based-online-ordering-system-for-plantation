<?php include 'inc/header.php'; ?>
<?php
if (isset($_GET['proId'])) {
    $proId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proId']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addCart = $ct->addToCart($quantity, $proId);
}
?>
<?php 
$cmrId = Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productId = $_POST['productId'];
    $insertCom = $pd->insertCompareDara($productId, $cmrId);
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
    $saveWlist = $pd->saveWishListData($proId, $cmrId);
}
?>
<style type="text/css">
	.mybutton{widows: 100px; float:left; margin-right: 30px;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">
				<?php 
                $getPd = $pd->getSingleProduct($proId);
                if ($getPd) {
                    while ($result = $getPd->fetch_assoc()) {
                        ?>
				<div class="grid images_3_of_2">
					<img src="admin/<?php echo $result['image']; ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					
					<div class="price">
						<p>Price :   <span>Rs.<?php echo $result['price']; ?></span></p>
						<p>Category :  <span><?php echo $result['catName']; ?></span></p>
						<p>Brand :   <span><?php echo $result['brandName']; ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>
					</div>
					




          

					<?php if (isset($minProAlert)) {
                            echo $minProAlert;
                        } ?>
					<span style="color:red; font-size:18px;">
						<?php if (isset($addCart)) {
                            echo $addCart;
                        } ?>
					</span>
					<?php if (isset($insertCom)) {
                            echo $insertCom;
                        }
                        if (isset($saveWlist)) {
                            echo $saveWlist;
                        } ?>
                        <?php 
                        $login = Session::get("cuslogin");
                        if ($login == true) {
                            ?>
                    <div class="add-cart">
                    	<div class="mybutton">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>							
							
						</form>
						</div>
						
					</div>
					<?php
                        } ?>					
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p><?php echo $result['body']; ?></p>
				</div>
				<?php
                    }
                } ?>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php 
                    $getCat = $cat->getAllCat();
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                            ?>
					<li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
					<?php
                        }
                    } ?>
				</ul>




        <!-- Trigger/Open The Modal -->
<button id="myBtn" class="myBtn">FeedBack</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])){
  $cus_name = $_POST['cus_name'];
    $feedback = $_POST['feedback'];
    $product_id = $_POST['product_id'];

    $conn = new mysqli('localhost','root','','db_shop');
    if($conn->connect_error){
        die('Connection Faild :'.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into tbl_feedback(product_id, cus_name, feedback)values(?, ?, ?)");
        $stmt->bind_param("iss",$product_id, $cus_name, $feedback);
        $stmt->execute();
        echo "Your Feedback successfully added...";
        $stmt->close();
        $conn->close();
    }

}

    
    
?>





    	<?php 
                $getPd = $pd->getSingleProduct($proId);
                if ($getPd) {
                    while ($result = $getPd->fetch_assoc()) {
                        ?>
				
			
    <form  method="post">
    <div class="form">
      <h2 id="">FeedBack Form</h2>
      <label for="fname">Name:</label><br>
      <input class="cus_name" type="text" name="cus_name" ><br>
      <label class="fedback-label" for="feedback">FeedBack:</label><br>
      <textarea id="txt-area" rows="4" cols="50" name="feedback"></textarea><br>
    <input type="hidden" class="buyfield" name="product_id" value="<?php echo $result['productId']; ?>"/>	
      <input class="sub-btn" type="submit" name="signup" value="Submit">
  
    </div>
</form> 
			
				<?php
                    }
                } ?>






  </div>

</div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

















				
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>
