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
        $errors[] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['last_name'])) {
        $errors[] = "Only letters and white space allowed in last name.";
    }

    // Validate