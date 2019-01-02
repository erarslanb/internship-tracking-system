<?php

include_once 'dbaccess.php';
    session_start();

    $company_name='';
    $city='';
    $company_phone = '';
    $address = '';
    $available_quota = '';

    $company_name = $_POST['company_name'];
    $city = $_POST['city'];
    $company_phone = $_POST['company_phone'];
    $address = $_POST['address'];
    $available_quota = $_POST['available_quota'];
     
    $queryLoginSt= mysqli_query($db,"INSERT INTO company(company_name,city,company_phone,address,available_quota) VALUES ('$company_name',						'$city','$company_phone','$address','$available_quota') ");
    ?>
    
