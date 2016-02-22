<?php 
    
    ////echo "<pre>"; print_r($_POST); echo "</pre>";
    ////echo "<pre>"; print_r($_SESSION); echo "</pre>";
    
    // print page title 
    print $page; ?>
    
    <table border="0" cellpadding="20">
        <tr>
            <th>item no</th>
            <th>category</th>
            <th>item</th>
            <th>size</th>
            <th>quantity</th>
            <th>price</th>     
        </tr>
        
        <?php foreach($_SESSION as $key=>$element): ?>
        <?php if(is_array($element)): ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $element["category"] ?></td>
            <td><?= $element["item"] ?></td>
        
            <?php foreach($xml->xpath("/menu/category[@name='{$element["category"]}']/item[@name='{$element["item"]}']/price") as $price): ?>
            <?php if($price == $element["price"]): ?>  
            
                <td><?= $price["size"] ?></td>
            
            <? endif ?>     
            <? endforeach ?>
            
            <td><?= $element["quantity"] ?></td>
            <td><?= "€", $element["price"] ?></td>
            
        <? endif ?>     
        <? endforeach ?>
            
        </tr>
               
        <tr>
            <td colspan="10" align="right"><b><?= "Total:  ", "€", $_SESSION["total_price"] ?><b></td>      
        </tr>
    </table> 
  
  
  
<?php  
    
    
    // if form has already been submitted check for errors
    if(isset($_POST["update"]))
    {
        if(empty($_POST["quantity"]) || preg_match("/^([0-9]+)$/", $_POST["quantity"]) === 0) 
        {
            $error = true;
        }
        
        // if no errors
        else
        { 
            //update cart
            include("update_cart.php");
            
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
                <td><h2><b><?= $item["name"] ?></b></h2><b><?= $item->description ?></b>
            
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
                                    $quantity = $_POST["quantity"];
                                    print "You must give a valid qty!";
                                }
                                
                                // 2. and reset pre-populated values for the rest of the items
                                else
                                {
                                    $quantity = $_POST["quantity"];
                                }
                            } 
                            // if there has been no error and a form has been submitted successfully
                            elseif(isset($_POST["add"]))
                            {
                                    $quantity = $_POST["quantity"];
                            }
                        ?>
                        qty:<input name="quantity" placeholder='<?= $quantity ?>' size=1 type="text" value ='<?= $quantity ?>'>
                        <input type="hidden" name="category" value='<?= $page ?>'>
                        <input type="hidden" name="item" value='<?= $item["name"] ?>'>
                        <input type="checkbox" name="remove" value="remove">remove 
                        <?php
                            // generate prices in sub-menu
                             foreach($xml->xpath("/menu/category[@name='{$page}']/item[@name='{$item["name"]}']/price") as $price): ?>
                             
                               <input type="radio" name="price" value='<?= $price ?>' <? if(isset($_POST["add"]) && isset($_POST["price"]) && ($item["name"] == $_POST["item"]) && (floatval($_POST["price"]) == floatval($price))) {echo "checked";} ?> ><?= $price["size"]," €", $price ?>
                              
                        <? endforeach ?> 
                <td>        
                    <input type="submit" name="update" value="update">
                </td>
                    </form>
                </td>
            </tr>
           
        <? endforeach ?> 
    </table>
                        
