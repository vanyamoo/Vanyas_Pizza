<?php 
    $page = "Checkout";
    include("../controller/config.php"); 
    print "Thank you for your order!";
    print "<br/>";
    print "Total paid: €". $_SESSION["total_price"];
    session_destroy(); 
?>
    
   
