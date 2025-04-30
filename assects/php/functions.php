<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'actions.php';

function validateSignupForm($form_data) {
    $response = array();

    // Validate first name
    if (empty($form_data['first_name'])) {
        $response['msg'] = "First name is required.";
        $response['status'] = "flase";
        $response['field'] = "first_name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['first_name'])) {
        $response['msg'] =  = "Only letters and white space allowed in first name.";
        $response['status'] = "flase";
        $response['field'] = "first_name";
    }

    // Validate last name
    if (empty($form_data['last_name'])) {
        $response['msg'] = "Last name is required.";
        $response['status'] = "flase";
        $response['field'] = "last_name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['last_name'])) {
        $response['msg'] = "Only letters and white space allowed in last name.";
        $response['status'] = "flase";
        $response['field'] = "last_name";

    // Validate email
    if (empty($form_data['email'])) {
        $response['msg'] = "Email is required.";
        $response['status'] = "flase";
        $response['field'] = "email";
    } elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $response['msg'] = "Invalid email format.";
        $response['status'] = "flase";
        $response['field'] = "email";
    }