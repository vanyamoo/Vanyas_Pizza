<?php   
    // generate sub-menu page
    print $page;
    $quantity = 1;
    // if form was submitted check if qty field was valid
    if(isset($_POST["size"]))
    {
        if(empty($_POST["quantity"]) || preg_match("/^([0-9]+)$/", $_POST["quantity"]) === 0) 
        {
            $error = true;
        }
        else
        {
            // remember what user added to cart
            $_SESSION["quantity"] = $_POST["quantity"];
            $_SESSION["category"] = $_POST["category"];
            $_SESSION["item"] = $_POST["item"];
            $_SESSION["size"] = $_POST["size"];
            $_SESSION["price"] = $_POST["price"];
        }    
    } ?>
    
    <table border="0" cellpadding="20">
        <?php foreach($xml->xpath("/menu/category[@name='{$page}']/item") as $item): ?>
        
            <tr>
                <td><h2><b><?= $item["name"] ?></b></h2><b><?= $item->description ?></b><br/>
            
            
                    <?php 
                        // generate prices in sub-menu
                        foreach($xml->xpath("/menu/category[@name='{$page}']/item[@name='{$item["name"]}']/price") as $price)
                        {
                            print $price["size"];
                            print $price; 
                        }
                    ?>
                </td>
                <td>
                    <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                        <?php 
                            // if qty field was not valid, warn the user
                            if(isset($error))
                            {
                                if($item["name"] == $_POST["item"])
                                {
                                    $quantity = 0;
                                    print "You must give a valid qty!";
                                }
                            }
                        ?>
                        qty:<input name="quantity" placeholder='<?= $quantity ?>' size=1 type="text" value ='<?= $quantity ?>'>
                        <input type="hidden" name="category" value='<?= $page ?>'>
                        <input type="hidden" name="item" value='<?= $item["name"] ?>'>
                        <input type="submit" name="size" value="small">
                        <input type="submit" name="size" value="large">
                        <input type="hidden" name="price" value='<?= $price ?>'>
                    </form>
                </td>
            </tr>
             
        <? endforeach ?> 
    </table> 
   


