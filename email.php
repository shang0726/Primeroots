<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Use this line if you installed PHPMailer via Composer
// Or include manually:
// require 'path-to-PHPMailer/src/Exception.php';
// require 'path-to-PHPMailer/src/PHPMailer.php';
// require 'path-to-PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';          // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your Gmail address
        $mail->Password = 'your-app-password';    // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
        $mail->Port = 587;                       // SMTP port

        // Sender and recipient settings
        $mail->setFrom('your-email@gmail.com', 'Your Name'); // Your "From" address
        $mail->addAddress('kianne22133@gmail.com');          // The email that receives messages

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "
            <h2>New Message from Your Website</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message"; // Plain-text fallback

        // Send the email
        if ($mail->send()) {
            echo "<script>
                    alert('Message sent successfully!');
                    window.location.href = 'contact.html'; // Redirect to your contact page
                  </script>";
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                window.location.href = 'contact.html'; // Redirect back
              </script>";
    }
} else {
    echo "Invalid request.";
}
?>
