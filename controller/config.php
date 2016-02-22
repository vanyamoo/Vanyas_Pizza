<?php 
    // enable sessions
    session_start();
    
    // set accumulators for items in cart
    if(count($_SESSION) == 0)
    {
        $_SESSION["accumulator"] = 0;
        $_SESSION["total_no_items"] = 0;
        $_SESSION["total_price"] = "0.00";
    }
?>
