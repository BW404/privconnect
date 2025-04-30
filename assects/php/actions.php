<?php
require_once 'functions.php';
is(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    print_r($response);
}