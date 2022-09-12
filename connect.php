<?php

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
        echo "registration successfully...";
        $stmt->close();
        $conn->close();
    }
    
?>