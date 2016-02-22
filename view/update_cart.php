<?php   
    $item_no = $_POST["item_no"];         
    if(isset($_POST["remove"]))
    {
        // remove item
        unset($_SESSION[$item_no]);
        $_SESSION["total_no_items"] = $_SESSION["total_no_items"] - $_POST["quantity"];
    }
    else
    {
        // update session with new post
        $_SESSION[$item_no] = $_POST;
    }
        
    $no_of_items = 0;
    $total_price = 0;
    // calculate new totals for no of items and price
    foreach($_SESSION as $key=>$elem)
    {
        if(is_array($elem))
        {
            $no_of_items += intval($elem["quantity"]);
            $total_price += intval($elem["quantity"]) * floatval($elem["price"]);
        }
    }
    // update total no of items and total price
    $_SESSION["total_no_items"] = $no_of_items;
    $_SESSION["total_price"] = $total_price;

?>

