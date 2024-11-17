<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "kian@primerootsinc.com"; // Replace with your Gmail address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html\r\n";

    $body = "
    <h2>New Message From Your Website</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Subject:</strong> $subject</p>
    <p><strong>Message:</strong></p>
    <p>$message</p>
    ";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>
        alert('Message sent successfully!');
        window.location.href = 'contact.html'; 
        </script>";
    } else {
        echo "<script>
        alert('Failed to send message. Please try again later.');
        window.location.href = 'contact.html'; 
        </script>";
    }
} else {
    echo "Invalid Request!";
}
?>
