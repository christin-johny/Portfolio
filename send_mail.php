<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the form data
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["Email"]);
    $number = htmlspecialchars($_POST["Number"]);
    $messageContent = htmlspecialchars($_POST["message"]);

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>Swal.fire({ title: 'Error!', text: 'Invalid email format.', icon: 'error' });</script>";
        exit;
    }

    // Prepare the email content
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // HTML message body
    $htmlMessage = "
    <html>
    <head>
        <title>Contact Form Submission</title>
        <style>
            h2 {
                color: #000;
            }
        </style>
    </head>
    <body>
        <h2>Contact Form Submission</h2><br>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone Number:</strong> $number</p>
        <p><strong>Message:</strong></p>
        <p>$messageContent</p>
    </body>
    </html>";

    // Set the recipient's email address
    $to = "christinjohnymankuthel@gmail.com";  // Updated email address

    // Send the email
    if (mail($to, "New Contact Form Submission", $htmlMessage, $headers)) {
        // If the mail was sent successfully, show a success alert
        echo "<script>
            Swal.fire({
                title: 'Mail Sent!',
                text: 'We will get back shortly!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.html';  // Redirect back to the home page
            });
        </script>";
    } else {
        // If the mail sending failed, show an error alert
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'There was an issue sending the mail. Please try again later.',
                icon: 'error'
            });
        </script>";
    }
}
?>
