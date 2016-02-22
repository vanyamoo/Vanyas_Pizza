<?php 
    //session_start();
    //access the query to the model.
    $xml = simplexml_load_file("/home/jharvard/vhosts/project0/model/menu.xml");
    
    //var_dump(getcwd()."menu.xml");
    
    // $xml now has a SimpleXMLElement object in it
    // that SimpleXMLElement has an xpath function
    // that lets us render xpath queries on it. 
    //$data['query'] = $xml->xpath($data['query']);

    // echo "<pre>";print_r( $data );echo "</pre>";
    //echo "<pre>";print_r($xml);echo "</pre>";

    // $data variable will now be returned with the result of the
    // query 
?>

