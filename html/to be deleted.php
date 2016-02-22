<?php   
    // generate sub-menu page
    print $page; ?>
    
    <table border="0" cellpadding="20">
        <?php foreach($xml->xpath("/menu/category[@name='{$page}']/item") as $item): ?>
        
            <tr>
                <td><h2><b><?= $item["name"] ?></b></h2><b><?= $item->description ?></b><br/>
            
            
                    <?php foreach($xml->xpath("/menu/category[@name='{$page}']/item[@name='{$item["name"]}']/price") as $price)
                        {
                            print $price["size"];
                            print $price; 
                        }
                    ?>
                </td>
                <td>
                    <form action="cart.php" method="post">
                        qty:<input name="quantity" placeholder="1" size=1 type="text" value ="1">
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
   


