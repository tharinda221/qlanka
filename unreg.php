<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe Dashboard</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #0f3e57;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #2280f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #f22222;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Unsubscribe InvestLK</h1>
        <form method="post">
            <label for="unreg_number">ඔබේ දුරකතන අංකය ඇතුලත් කරන්න</label>
            <input type="text" name="unreg_number" id="unreg_number" placeholder="Enter your phone number" required>
            <button type="submit">Unsubscribe</button>
        </form>
    </div>
    
    <?php
    define('WP_USE_THEMES', false);
    require_once('../wp-load.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the phone number is set and not empty
        if (isset($_POST["unreg_number"]) && !empty($_POST["unreg_number"])) {
            $unreg_number = $_POST["unreg_number"];
            
            if (un_reg_user($unreg_number)) {
                wp_logout();
                $_SESSION['otp_step'] = 'step1';
                header("Location: https://guide.flashlk.click/");
                exit();
            } else {
                // Redirect to the home page with a failure message
                header("Location: https://guide.flashlk.click/");
                exit();
            }
        }
    }

    // Function to validate the phone number (you need to implement this function)
    function un_reg_user($unreg_number) {
        $url = "https://myapplanka.com/IvApp/web/unSubscribeUser?phone=" . urlencode($unreg_number);
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
    	if ($json_response['status'] === 'SUCCESS') {
            return true;
    	}
    	else {
    	    return false;
    	}
    	
    }
    ?>
</body>
</html>