<?php
    // generate main menu page
    foreach($xml->xpath("/menu/category") as $category)
        {
            print "<li>";
            print "<a href='{$category["file_name"]}'>";
            print $category["name"];
            print "</a>";
            print "</li>";
        }
?>


