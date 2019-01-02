<?php

include_once 'dbaccess.php';
    session_start();

    $id = $_SESSION['secid'];
    $company_name='';
    $city='';
    $company_phone = '';
    $address = '';
    $available_quota = '';

    $company_name = $_POST['company_name'];
    $_SESSION['company_name'] = $company_name;
    $city = $_POST['city'];
    $company_phone = $_POST['company_phone'];
    $address = $_POST['address'];
    $available_quota = $_POST['available_quota'];

    $queryComp = mysqli_query($db,"INSERT INTO company(company_name,city,company_phone,address,available_quota) VALUES ('$company_name','$city','$company_phone','$address',$available_quota) ");
    $queryAdd = mysqli_query($db, "INSERT INTO adds VALUES ($id, '$company_name', '$city')");

    if($queryComp && $queryAdd){
      $_SESSION['add'] = 'true';
      header("Location: welcomeSecretary.php");
    }
    else{
      $_SESSION['add'] = 'false';
      header("Location: welcomeSecretary.php");
    }



?>
