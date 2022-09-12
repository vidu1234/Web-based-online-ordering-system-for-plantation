<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>
<?php 
if (isset($_GET['shiftid'])) {
    $id 	= $_GET['shiftid'];
    $time 	= $_GET['time'];
    $price 	= $_GET['price'];

    $shift = $ct->productShifted($id, $time, $price);
}

if (isset($_GET['delproid'])) {
    $id 	= $_GET['delproid'];
    $time 	= $_GET['time'];
    $price 	= $_GET['price'];

    $delOrder = $ct->delProductShifted($id, $time, $price);
}
 ?>







      
<?php 
//index.php
$connect = mysqli_connect("localhost", "root", "", "db_shop");
$query = "SELECT * FROM tbl_order";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ date:'".$row["date"]."', price:".$row["price"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>



<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'date',
 ykeys:['price'],
 labels:['Price'],
 hideHover:'auto',
 stacked:true
});
</script>
       
      
















<div class="total-order">

<?php 
                        
                        $getsumincome = $ct->getincomeTotal();
                        if ($getsumincome) {
                            while ($result = $getsumincome->fetch_assoc()) {
                                ?>
						
							<td><h2 class="head">Total Income</h2></td>
							
							<td>Rs.<?php echo $result['sumincome']; ?>.00</td>
							
                                
							<?php
                                } ?>
						</tr>
						<?php
                            }
                        ?>


</div>



        <div class="grid_10">
            <div class="box-report">
                <h2>Income Report</h2>
                <?php
                 if (isset($shift)) {
                     echo $shift;
                 }
    if (isset($delOrder)) {
        echo $delOrder;
    }
  ?>
  	



                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Cust ID</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        
                        $getOrder = $ct->getAllOrderProduct();
                        if ($getOrder) {
                            while ($result = $getOrder->fetch_assoc()) {
                                ?>
						
							
							
                            <tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['cmrId']; ?></td>
                            <td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
                            
						
                                
							
						</tr>
						<?php
                            }
                        } ?>
					</tbody>
				</table>

               </div>
            </div>
        </div>






        
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>











<?php include 'inc/footer.php';?>
