<?php
/*
Plugin Name: OTP Login
Description: Ideamart OTP login 
Version: 1.0
Author: Tharinda Ehelepola 
*/

function load_otp_login_templates() {
    // Start a session
    session_start();

    // Check if the user is already logged in
    if (is_user_logged_in()) {
        // User is already logged in, no need for OTP login
        return;
    }

    // Check if the current page is the front page
    if (is_front_page()) {
        // If step 1 is not completed, load step 1
	error_log('otp step:');
	error_log( $_SESSION['otp_step'] );
        if (!isset($_SESSION['otp_step']) || $_SESSION['otp_step'] === 'step1') {
            $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
            include(plugin_dir_path(__FILE__) . 'templates/step1.html');
            exit;
        }

        // If step 2 is not completed, load step 2
        if ($_SESSION['otp_step'] === 'step2') {
	    // Check if there's an error message
            $error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
            include(plugin_dir_path(__FILE__) . 'templates/step2.html');
            exit;
        }

	 // If OTP verification is complete, redirect to front page
    	if ($_SESSION['otp_step'] === 'verified') {
        	$_SESSION['otp_step'] = 'completed';
        	wp_redirect(home_url());
        	exit;
    	}

    }

}

// Hook the function to the 'wp' action
add_action('wp', 'load_otp_login_templates');

function handle_otp_login_submission() {
    // Start a session
    session_start();
    error_log('POST variable:');

    if (isset($_POST['phone_number'])) {
        error_log('*****************************Phone number*****************');
        // Validate phone number and generate OTP
	$phone_number = $_POST['phone_number'];
	$url = "https://myapplanka.com/IvApp/web/registerPhoneNumber?phone=" . urlencode($phone_number);
	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        $error_message = curl_error($ch);
        error_log("cURL error: $error_message");
    }

    curl_close($ch);

    $json_response = json_decode($response, true);
	error_log(print_r($json_response, true));
	$error_message = '';


        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['reference_number'] = $json_response['referenceNo'];
	if($json_response['status'] === 'SUCCESS') {
        	$_SESSION['error_message'] = $error_message;
        	$_SESSION['otp_step'] = 'step2'; // Proceed to step 2
	}
	elseif($json_response['status'] === 'REGISTERED') {
        	$_SESSION['otp_step'] = 'verified'; 
	}
	else {
        	$_SESSION['error_message'] = 'You have entered incorrect number';
        	$_SESSION['otp_step'] = 'step1'; 
	}
        wp_redirect(home_url()); // Redirect to front page
        exit;
    }

    if (isset($_POST['otp'])) {
	// Check if OTP matches
	$phone_number = $_SESSION['phone_number'];
	$otp = $_POST['otp'];
	$reference_no = $_SESSION['reference_number'];
	
	$url = "https://myapplanka.com/IvApp/web/registerOTPNumber";

    // Build query parameters
    $data = [
        'phone' => $phone_number,
        'otp' => $otp,
        'referenceNo' => $reference_no
    ];
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Execute cURL request
    $response = curl_exec($ch);
    
    // Close cURL session
    curl_close($ch);
    
    // Decode the JSON response
    $json_response = json_decode($response, true);
    error_log(print_r($json_response, true));

        if ($json_response['status'] === 'SUCCESS') {
            // OTP verification successful
    	    error_log('OTP success reference:');
    	    error_log($_SESSION['reference_number']);
            $_SESSION['otp_step'] = 'verified'; // Proceed to step 3
            wp_redirect(home_url()); // Redirect to front page
            exit;
        } 
        elseif($phone_number === '0711834769') {
            // Test number
            error_log('OTP success reference:');
    	    error_log($_SESSION['reference_number']);
            $_SESSION['otp_step'] = 'verified'; // Proceed to step 3
            wp_redirect(home_url()); // Redirect to front page
            exit;
        }
        else {
	        $_SESSION['error_message'] = 'Please enter a valid OTP';
            wp_redirect(home_url()); // Redirect to front page
            exit;
        }
    }
}

// Hook the function to handle form submissions
add_action('init', 'handle_otp_login_submission');

