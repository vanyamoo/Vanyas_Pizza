<?php   
    // retrieve accumulators from $_SESSION
    $accum = intval($_SESSION["accumulator"]);
    $no_items = intval($_SESSION["total_no_items"]);
    $t_price = floatval($_SESSION["total_price"]);
    
    // add item to cart:
        // first add "size" to $_POST
        foreach($xml->xpath("/menu/category[@name='{$_POST["category"]}']/item[@name='{$_POST["item"]}']/price") as $price)
        {
            if($price == $_POST["price"])
            {        
                $_POST["size"] = strval($price["size"]);
            }
        }
    $_SESSION["item " . $accum] = $_POST;
    
    // update accumulators
    $accum++;
    $no_items = intval($_SESSION["total_no_items"]) + intval($_POST["quantity"]);
    $t_price = number_format((100 * floatval($_SESSION["total_price"]) + intval($_POST["quantity"]) * 100 * ($_POST["price"])) / 100, 2);
    
    // put back updated accumulators in $_SESSION
    $_SESSION["accumulator"] = $accum;
    $_SESSION["total_no_items"] = $no_items;
    $_SESSION["total_price"] = $t_price;
?>
         
