```php
<?php

$errors = [];

// Form submitted check
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

// Get values
$username   = trim($_POST["username"] ?? "");
$password   = $_POST["password"] ?? "";
$name       = trim($_POST["name"] ?? "");
$card       = trim($_POST["creditcardno"] ?? "");
$email      = trim($_POST["email"] ?? "");
$phone      = trim($_POST["phoneno"] ?? "");
$dob        = trim($_POST["dob"] ?? "");
$gender     = trim($_POST["gender"] ?? "");
$address    = trim($_POST["address"] ?? "");
$city       = trim($_POST["city"] ?? "");
$state      = trim($_POST["state"] ?? "");
$pincode    = trim($_POST["pincode"] ?? "");



if ($username === "") {
    $errors[] = "Username is required.";
} elseif (!preg_match("/^[A-Za-z0-9_]{4,20}$/", $username)) {
    $errors[] = "Username must contain 4-20 letters, numbers or underscore.";
}




if ($password === "") {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 8) {
    $errors[] = "Password must contain at least 8 characters.";
}



if ($name === "") {
    $errors[] = "Full name is required.";
} elseif (!preg_match("/^[A-Za-z ]+$/", $name)) {
    $errors[] = "Name should contain only letters and spaces.";
}



if ($card === "") {
    $errors[] = "Credit card number is required.";
} elseif (!preg_match("/^[0-9]{16}$/", $card)) {
    $errors[] = "Credit card number must contain exactly 16 digits.";
}



if ($email === "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}



if ($phone === "") {
    $errors[] = "Phone number is required.";
} elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
    $errors[] = "Phone number must contain exactly 10 digits.";
}




if ($dob === "") {
    $errors[] = "Date of birth is required.";
} else {

    $date = DateTime::createFromFormat("Y-m-d", $dob);

    if (!$date || $date->format("Y-m-d") !== $dob) {
        $errors[] = "Please enter a valid date of birth.";
    } elseif ($date > new DateTime()) {
        $errors[] = "Date of birth cannot be a future date.";
    }
}



$allowedGender = ["Male", "Female", "Other"];

if ($gender === "") {
    $errors[] = "Please select your gender.";
} elseif (!in_array($gender, $allowedGender, true)) {
    $errors[] = "Invalid gender selected.";
}




if ($address === "") {
    $errors[] = "Address is required.";
}




if ($city === "") {
    $errors[] = "City is required.";
} elseif (!preg_match("/^[A-Za-z ]+$/", $city)) {
    $errors[] = "City should contain only letters and spaces.";
}




if ($state === "") {
    $errors[] = "State is required.";
} elseif (!preg_match("/^[A-Za-z ]+$/", $state)) {
    $errors[] = "State should contain only letters and spaces.";
}



if ($pincode === "") {
    $errors[] = "Pincode is required.";
} elseif (!preg_match("/^[0-9]{6}$/", $pincode)) {
    $errors[] = "Pincode must contain exactly 6 digits.";
}



if (!empty($errors)) {

    ?>

    <!DOCTYPE html>
    <html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Validation Error</title>

        <style>

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #667eea, #764ba2);

                min-height: 100vh;

                display: flex;
                justify-content: center;
                align-items: center;

                padding: 30px;
            }

            .card {
                background: white;

                width: 100%;
                max-width: 600px;

                padding: 35px 40px;

                border-radius: 18px;

                box-shadow:
                    0 15px 40px rgba(0,0,0,0.25);
            }

            h1 {
                text-align: center;
                color: #dc3545;

                margin-bottom: 20px;
            }

            .error {
                background: #ffe6e6;

                border-left: 5px solid #dc3545;

                padding: 12px;

                margin-bottom: 10px;

                color: #721c24;

                border-radius: 5px;
            }

            .button {
                display: block;

                width: 100%;

                margin-top: 25px;

                padding: 13px;

                border-radius: 8px;

                background:
                    linear-gradient(135deg, #667eea, #764ba2);

                color: white;

                text-align: center;

                text-decoration: none;

                font-weight: bold;
            }

        </style>

    </head>

    <body>

        <div class="card">

            <h1>Validation Failed</h1>

            <?php foreach ($errors as $error): ?>

                <div class="error">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endforeach; ?>

            <a href="index.html" class="button">
                Go Back to Registration
            </a>

        </div>

    </body>
    </html>

    <?php

    exit;
}



// Escape output
$safeUsername = htmlspecialchars($username);
$safeName     = htmlspecialchars($name);
$safeEmail    = htmlspecialchars($email);
$safePhone    = htmlspecialchars($phone);
$safeDob      = htmlspecialchars($dob);
$safeGender   = htmlspecialchars($gender);
$safeAddress  = nl2br(htmlspecialchars($address));
$safeCity     = htmlspecialchars($city);
$safeState    = htmlspecialchars($state);
$safePincode  = htmlspecialchars($pincode);

// Show only last 4 digits of card
$maskedCard = "**** **** **** " . substr($card, -4);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registration Successful</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {

            font-family: Arial, sans-serif;

            background:
                linear-gradient(135deg, #667eea, #764ba2);

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px;
        }

        .card {

            background: white;

            width: 100%;

            max-width: 600px;

            padding: 35px 40px;

            border-radius: 18px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.25);
        }

        h1 {

            text-align: center;

            color: #28a745;

            margin-bottom: 10px;
        }

        .success {

            text-align: center;

            color: #555;

            margin-bottom: 25px;
        }

        .details {

            border: 1px solid #ddd;

            border-radius: 10px;

            overflow: hidden;
        }

        .row {

            display: flex;

            border-bottom: 1px solid #ddd;
        }

        .row:last-child {

            border-bottom: none;
        }

        .label {

            width: 35%;

            background: #f5f5f5;

            padding: 12px;

            font-weight: bold;

            color: #333;
        }

        .value {

            width: 65%;

            padding: 12px;

            color: #555;

            word-break: break-word;
        }

        .button {

            display: block;

            width: 100%;

            margin-top: 25px;

            padding: 13px;

            border-radius: 8px;

            background:
                linear-gradient(135deg, #667eea, #764ba2);

            color: white;

            text-align: center;

            text-decoration: none;

            font-weight: bold;
        }

        .button:hover {

            opacity: 0.9;
        }

        @media (max-width: 600px) {

            .card {
                padding: 25px 20px;
            }

            .row {
                display: block;
            }

            .label,
            .value {
                width: 100%;
            }
        }

    </style>

</head>

<body>

<div class="card">

    <h1>Registration Successful</h1>

    <p class="success">
        All details have been successfully validated.
    </p>

    <div class="details">

        <div class="row">
            <div class="label">Username</div>
            <div class="value">
                <?php echo $safeUsername; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Password</div>
            <div class="value">
                ********
            </div>
        </div>

        <div class="row">
            <div class="label">Full Name</div>
            <div class="value">
                <?php echo $safeName; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Credit Card</div>
            <div class="value">
                <?php echo $maskedCard; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Email</div>
            <div class="value">
                <?php echo $safeEmail; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Phone</div>
            <div class="value">
                <?php echo $safePhone; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Date of Birth</div>
            <div class="value">
                <?php echo $safeDob; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Gender</div>
            <div class="value">
                <?php echo $safeGender; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Address</div>
            <div class="value">
                <?php echo $safeAddress; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">City</div>
            <div class="value">
                <?php echo $safeCity; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">State</div>
            <div class="value">
                <?php echo $safeState; ?>
            </div>
        </div>

        <div class="row">
            <div class="label">Pincode</div>
            <div class="value">
                <?php echo $safePincode; ?>
            </div>
        </div>

    </div>

    <a href="index.html" class="button">
        Back to Registration
    </a>

</div>

</body>

</html>
```
