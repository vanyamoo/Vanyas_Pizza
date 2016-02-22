<?php
    // render page header 
    require("header.php");
    
    // determine which page to render
    switch ($page)
    {
        case 'Index':
            include("main_menu.php");
            break;
        case 'Pizzas':
            include("../view/sub_menus.php");
            break;
        case 'Salads':
            include("../view/sub_menus.php");
            break;
        case 'Pasta':
            include("../view/sub_menus.php");
            break;
        case 'Wraps':
            include("../view/sub_menus.php");
            break;
        case 'Antipasti/Starters':
            include("../view/sub_menus.php");
            break;
        case 'Side Orders':
            include("../view/sub_menus.php");
            break;
        case 'Desserts':
            include("../view/sub_menus.php");
            break;
        case 'About':
            include("../view/cart_content.php");
            break;
        case 'Your Cart':
            include("../view/cart_content.php");
            break;    
    }
    
    // render page footer
    require("footer.php");
?>


