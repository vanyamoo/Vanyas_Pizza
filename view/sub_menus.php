<?php  
 
    // print sub-menu title
    print $page; 
    
    // if form has not yet been submitted use this value to pre-populate qty field
    if(!isset($_POST["add"]))
    {
        $quantity = 1;
    }
    
    // therwise if form has already been submitted check for errors
    else
    {
        if( empty($_POST["price"]) || empty($_POST["quantity"]) || preg_match("/^([0-9]+)$/", $_POST["quantity"]) === 0) 
        {
            $error = true;
        }
        
        // if no errors
        else
        { 
            //add item to cart
            include("add_to_cart.php");
            
            ////print "<br/>"; print "accumulator:" . $accum;
            ////print "<br/>"; print "session(accumulator):" . $_SESSION["accumulator"];
        }    
    }
    ////print "<br/>"; print "No of items in session:" . count($_SESSION); print "<br/>";
    
    ////print "<br/>"; print "post:  "; echo "<pre>"; print_r($_POST); echo "</pre>";
    ////print "session:  "; echo "<pre>"; print_r($_SESSION); echo "</pre>";
    ////print "<br/>"; print $_SERVER["PHP_SELF"]; // current file
    ////print "<br/>"; print rtrim(dirname($_SERVER["PHP_SELF"]), "/\\"); // directory name of $_SERVER["PHP_SELF"]
    ////print "<br/>"; print $_SERVER["HTTP_HOST"]; // what's in the "host" field in the HTTP request
    
?>
    
    <table border="0" cellpadding="20">
        <?php 
            //render sub-menu:
            //generate items in sub-menu
            foreach($xml->xpath("/menu/category[@name='{$page}']/item") as $item): ?> 
        
            <tr>
                <td><h2><b><?= $item["name"] ?></b></h2><?= $item->description ?>
            
                </td>
                <td>
                    <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                        <?php 
                            // if there has been an error 
                            if(isset($error))
                            {
                                // 1. request valid input from user for the relevent item
                                if($item["name"] == $_POST["item"])
                                {
                                    // if error was caused by empty size button
                                    if(empty($_POST["price"]))
                                    {
                                        print "Please choose size!";
                                        $quantity = $_POST["quantity"];
                                        // also check if user gave valid qty
                                        if(empty($_POST["quantity"]) || preg_match("/^([0-9]+)$/", $_POST["quantity"]) === 0)
                                            {
                                                $quantity = $_POST["quantity"];
                                                print "You must give a valid qty!";  
                                            }
                                    }
                                    // otherwise if error was caused by user not giving valid qty
                                    else
                                    {
                                        $quantity = $_POST["quantity"];
                                        print "You must give a valid qty!";
                                    }
                                }
                                // 2. and reset pre-populated values for the rest of the items
                                else
                                {
                                    $quantity = 1;
                                }
                            } 
                            // if there has been no error and a form has been submitted successfully
                            elseif(isset($_POST["add"]))
                            {
                                // 1. display values chosen by user for the relevent item
                                if($item["name"] == $_POST["item"])
                                {
                                    $quantity = $_POST["quantity"];
                                }
                                // 2. and reset pre-populated values for the rest of the items
                                else
                                {
                                    $quantity = 1;
                                } 
                            }
                            ////print $item["name"];
                        ?>
                        </td>
                        <td>
                            qty:<input name="quantity" placeholder='<?= $quantity ?>' size=1 type="text" value ='<?= $quantity ?>'>
                        </td>
                        <input type="hidden" name="category" value='<?= $page ?>'>
                        <input type="hidden" name="item" value='<?= $item["name"] ?>'>
                        <td>
                        <?php
                            // generate prices in sub-menu
                             foreach($xml->xpath("/menu/category[@name='{$page}']/item[@name='{$item["name"]}']/price") as $price): ?>
                             
                               <input type="radio" name="price" value='<?= $price ?>' <? if(isset($_POST["add"]) && isset($_POST["price"]) && ($item["name"] == $_POST["item"]) && (floatval($_POST["price"]) == floatval($price))) {echo "checked";} ?> ><?= $price["size"]," €", $price ?><br>
                               
                        <? endforeach ?> 
                        </td>
                <td>        
                    <input type="submit" name="add" value="+">
                </td>
                    </form>
            </tr>
           
        <? endforeach ?> 
    </table>
   
