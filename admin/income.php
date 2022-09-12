<?php include 'inc/header.php';?>
<?php include '../classes/Brand.php'; ?>


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



 <head>
  <link rel="stylesheet" href="css/layout.css?v=<?php echo time(); ?>"/>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  <style>
    .container_12{
      
      min-height: 935px;
    }
    
  </style>
  
 </head>
 <body>
  <br /><br />
  <div class="container-stat" style="width:900px;">
   <h2 align="center">Daily Income</h2>
   
   <br /><br />
   <div id="chart"></div>
  </div>
 </body>
</html>

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
