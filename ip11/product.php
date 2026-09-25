<?php
$host = "localhost:3307";
$username = "root";
$password = "12345";
$dbname = "test";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$action = $_POST['action'];


// ================= SIGN UP =================

if ($action == "signup") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_password = $_POST['password'];
    $otp = $_POST['otp'];

    $sql = "INSERT INTO users
            (name, email, phone, password, otp)
            VALUES
            ('$name', '$email', '$phone', '$user_password', '$otp')";

    if (mysqli_query($conn, $sql)) {

        echo "<h2>Registration Successful!</h2>";
        echo "Welcome, " . $name;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}


// ================= LOGIN =================

elseif ($action == "login") {

    $email = $_POST['email'];
    $user_password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$user_password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        echo "<h2>Login Successful!</h2>";
        echo "Welcome, " . $row['name'];

    } else {

        echo "<h2>Wrong Username or Password</h2>";
    }
}


// ================= ORDER =================

elseif ($action == "order") {

    $product = $_POST['product'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];

    $sql = "INSERT INTO orders
            (product, price, quantity, customer_name,
             customer_phone, address, payment)
            VALUES
            ('$product', '$price', '$quantity', '$customer_name',
             '$customer_phone', '$address', '$payment')";

    if (mysqli_query($conn, $sql)) {

        echo "<h2>Order Placed Successfully!</h2>";

        echo "Customer Name: " . $customer_name . "<br>";
        echo "Product: " . $product . "<br>";
        echo "Price: ₹" . $price . "<br>";
        echo "Quantity: " . $quantity . "<br>";
        echo "Payment: " . $payment;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}


else {

    echo "Invalid Request";
}


mysqli_close($conn);

?>