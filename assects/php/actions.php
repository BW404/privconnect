<?php
require_once 'functions.php';
if(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    print_r($response);
}