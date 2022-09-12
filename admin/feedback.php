<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>









        <div class="grid_10">
            <div class="box-report">
    



                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Feedback ID</th>
							<th>Product ID</th>
							<th>Customer Name</th>
							<th>Feedback</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                        
                        $getFeedback = $ct->getFeedback();
                        if ($getFeedback) {
                            while ($result = $getFeedback->fetch_assoc()) {
                                ?>
						
							
							
                            
							<td><?php echo $result['feedback_id']; ?></td>
                            <td><?php echo $result['product_id']; ?></td>
							<td><?php echo $result['cus_name']; ?></td>
                            <td><?php echo $result['feedback']; ?></td>
                            
							
						</tr>
						<?php
                            }
                        } ?>
                                
						
						</tr>
					
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
