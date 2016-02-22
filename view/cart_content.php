<?php 
    
    
    
    // print page title 
    print $page; 
    
    // if form has already been submitted and "remove" was left blank - check for errors in qty field
    if(isset($_POST["update"]) && !isset($_POST["remove"]))
    {
        if(empty($_POST["quantity"]) || preg_match("/^([0-9]+)$/", $_POST["quantity"]) === 0) 
        {
            $err = true;
            $_POST["err"] = true;
        }
        else
        {
            //update cart
            include("update_cart.php");
        }
    }    
    // if form has already been submitted and "remove" was checked
    if(isset($_POST["remove"]))
    { 
        //update cart
        include("update_cart.php");
        
        ////print "<br/>"; print "accumulator:" . $accum;
        ////print "<br/>"; print "session(accumulator):" . $_SESSION["accumulator"];
    }
    
    ////echo "<pre>post:"; print_r($_POST); echo "</pre>";
    ////echo "<pre>session:"; print_r($_SESSION); echo "</pre>";
    ////echo "<pre>server:"; print_r($_SERVER); echo "</pre>";
    ?>
    
    <table border="0" cellpadding="20">
        <tr>
            
            <th></th>
            <th>no</th>
            <th>category</th>
            <th>item</th>
            <th>size</th>
            <th>quantity</th>
            <th>price</th> 
            <th></th>    
        </tr>
        <?php $i = 1; ?>
        <?php foreach($_SESSION as $key=>$element): ?>
            <?php if(is_array($element)): ?>
            <tr>
                <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                    
                    <td>
                        <input type="checkbox" name="remove" value="remove">remove
                    </td>
                    <td><?= $i++ ?></td>
                    <td><input type="hidden" name="category" value='<?= $element["category"] ?>'><?= $element["category"] ?></td>
                    <td><input type="hidden" name="item" value='<?= $element["item"] ?>'><?= $element["item"] ?></td>
                    <td><input type="hidden" name="size" value='<?= $element["size"] ?>'><?= $element["size"] ?></td>
                    <td>
                        <?php 
                            // if error - warn user in the relevent field
                            if(isset($err) && $element["item"]== $_POST["item"] && $element["category"]== $_POST["category"] && $element["size"]== $_POST["size"])
                            {
                                print "You must give a valid qty!";
                                $element["quantity"] = $_POST["quantity"];
                            } 
                        ?>
                        <input name="quantity" placeholder='<?= $element["quantity"] ?>' size=1 type="text" value ='<?= $element["quantity"] ?>'>
                    </td>
                    <td>
                    <?php 
                        // if error - warn user in the relevent field
                        if(!(isset($err) && $element["item"]== $_POST["item"] && $element["category"]== $_POST["category"] && $element["size"]== $_POST["size"]))
                        {
                            print "€". number_format($element["quantity"] * $element["price"], 2);
                        } 
                    ?>
                   
                    
                    </td>
                        <input type="hidden" name="price" value='<?= $element["price"] ?>'>
                    <td>
                        <input type="hidden" name="item_no" value='<?= $key ?>'>
                        <input type="submit" name="update" value="update">
                    </td>
                </form>
            <? endif ?>     
        <? endforeach ?>
            
        </tr>   
        <tr>
            <td colspan="7" align="right">
                <b>
                <?php
                    if(!isset($err))
                    {
                        print "Total:  €". number_format($_SESSION["total_price"], 2);
                    }
                ?>
                </b>
            </td>      
        </tr>
    </table> 
                                
