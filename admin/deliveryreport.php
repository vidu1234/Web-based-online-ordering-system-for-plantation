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


<div class="total-order">

<?php 
                        
                        $getsum = $ct->getAllOrderTotal();
                        if ($getsum) {
                            while ($result = $getsum->fetch_assoc()) {
                                ?>
						
							<td><h2 class="head">Total Orders</h2></td>
							
							<td><?php echo $result['sumorder']; ?></td>
							
                                
							<?php
                                } ?>
						</tr>
						<?php
                            }
                        ?>


</div>

<div class="shifted-order">

<?php 
                        
                        $getsumshift = $ct->getshifetedOrderTotal();
                        if ($getsumshift) {
                            while ($result = $getsumshift->fetch_assoc()) {
                                ?>
						
							<td><h2 class="head">Shifted Orders</h2></td>
							
							<td><?php echo $result['shiftedorder']; ?></td>
							
                                
							<?php
                                } ?>
						</tr>
						<?php
                            }
                        ?>


</div>

<div class="pending-order">

<?php 
                        
                        $getsumpending = $ct->getpendingOrderTotal();
                        if ($getsumpending) {
                            while ($result = $getsumpending->fetch_assoc()) {
                                ?>
						
							<td><h2 class="head">Pending Orders</h2></td>
							
							<td><?php echo $result['pendingorder']; ?></td>
							
                                
							<?php
                                } ?>
						</tr>
						<?php
                            }
                        ?>


</div>










        <div class="grid_10">
            <div class="box-report">
                <h2>Delivery Report</h2>
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
							<th>Order Time</th>
							<th>Cust ID</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        
                        $getOrder = $ct->getAllOrderProduct();
                        if ($getOrder) {
                            while ($result = $getOrder->fetch_assoc()) {
                                ?>
						
							
							<?php if ($result['status'] == '0') {
                                    ?>
                            <tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['cmrId']; ?></td>
                            
							<td><a>Shifted</a></td>
                                
							<?php
                                } ?>
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
