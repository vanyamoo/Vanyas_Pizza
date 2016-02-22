<? if(!isset($_GET["viewcart"]) && !isset($_POST["update"])): ?>
    <form action="cart.php" method="get">
<? $no_items = $_SESSION["total_no_items"]; ?>
<? $total_price = $_SESSION["total_price"]; ?>
    <?php if($no_items == 1)
          {
              $items = "item";
          }
          else
          {
              $items = "items";
          }
    ?>
        <input type="submit" name="viewcart" value="View Cart(<?= $no_items . " " . $items . "/ €" . number_format($total_price, 2) ?>)">
    </form>
<? 
    elseif(($_SERVER["PHP_SELF"] == "/cart.php" && $_SESSION["total_price"] != "0.00" && !isset($_POST["err"])) 
        || (isset($_POST["update"]) && !isset($_POST["err"]))): ?>
    <form action="checkout.php" method="get">
        <input type="submit" name="checkout" value="checkout">
    </form>
<? endif ?>

