<?php
include 'header.php';

$first_name = $last_name = $email = $phone = $address = $password = $confirm_password = "";
$first_name_error = $last_name_error = $email_error = $phone_error = $address_error = $password_error = $confirm_password_error = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Add validation logic here
    if (empty($first_name)) {
        $first_name_error = "First Name is required";
        $error = true;
    }

    if (empty($last_name)) {
        $last_name_error = "Last Name is required";
        $error = true;
    }

    if (empty($email)) {
        $email_error = "Email is required";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $error = true;
    }

    if (empty($phone)) {
        $phone_error = "Phone number is required";
        $error = true;
    } elseif (!preg_match("/^(\+|00\d{1,3})?[- ]?\d{7,12}$/", $phone)) {
        $phone_error = "Invalid phone number format";
        $error = true; 
    }

    if (empty($address)) {
        $address_error = "Address is required";
        $error = true;
    }

    if (empty($password)) {
        $password_error = "Password is required";
        $error = true;
    } elseif (strlen($password) < 6) {
        $password_error = "Password should be at least 6 characters";
        $error = true;
    }

    if (empty($confirm_password)) {
        $confirm_password_error = "Confirm Password is required";
        $error = true;
    } elseif ($password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match";
        $error = true;
    }

    if (!$error) {
        include __DIR__ . "/../tools/db.php";
        $dbConnection = getDatabaseConnection();

        $statement = $dbConnection->prepare("SELECT ID FROM table2 WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            $email_error = "Email already exists";
            $error = true;
        }

        $statement->close();

        if (!$error) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $created_at = date("Y-m-d H:i:s");

            $statement = $dbConnection->prepare("INSERT INTO table2 (first_name, last_name, email, phone, address, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssss", $first_name, $last_name, $email, $phone, $address, $password, $created_at);
            $statement->execute();

            $insert_id = $statement->insert_id;
            $statement->close();

            session_start();
            $_SESSION["id"] = $insert_id;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["address"] = $address;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["created_at"] = $created_at;

            header("Location: /index.php");
            exit;
        }
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            
            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?= htmlspecialchars($first_name) ?>">
                        <span class="text-danger"><?= $first_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?= htmlspecialchars($last_name) ?>">
                        <span class="text-danger"><?= $last_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?= htmlspecialchars($email) ?>">
                        <span class="text-danger"><?= $email_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?= htmlspecialchars($phone) ?>">
                        <span class="text-danger"><?= $phone_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?= htmlspecialchars($address) ?>">
                        <span class="text-danger"><?= $address_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password">
                        <span class="text-danger"><?= $password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="confirm_password">
                        <span class="text-danger"><?= $confirm_password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-8 offset-sm-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>