<?php
    include 'classes.php';

    $consult=new Consult();

    switch($_POST['entity']){
        case 'roomType':
            $consult->roomTypeList($_POST['roomType']);
            break;
        case 'roomQuantity':
            $consult->roomQuantityList($_POST['roomQuantity']);
            break;
        case 'enterprise':
            $consult->enterpriseList();
            break;
        case 'country':
            $consult->cityList($_POST['country']);
            break;
        case 'profession':
           $consult->professionList();
            break;
    }
?>