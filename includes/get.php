<?php
    include 'classes.php';

    $consult=new Consult();

    switch($_POST['entity']){
        case 'searchPerson':
            $consult->getPerson($_POST['idPerson']);
            break;
        case 'roomTariff':
            $consult->tariffList($_POST['roomQuantity'],$_POST['roomType']);
            break;
        case 'roomType':
            $consult->roomTypeList($_POST['roomType'],$_POST['startDate'],$_POST['finishDate']);
            break;
        case 'roomQuantity':
            $consult->roomQuantityList($_POST['roomQuantity'],$_POST['startDate'],$_POST['finishDate']);
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
        case 'booking':
            $consult->getBooking($_POST['id']);
            break;
        case 'bookingRooms':
            $consult->getBookingRooms($_POST['id']);
            break;
        case 'searchTitular':
           $consult->getTitular($_POST['idTitular']);
            break;
    }
?>