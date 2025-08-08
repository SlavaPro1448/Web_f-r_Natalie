<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["first-name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));
    $recipient = "info@hausverwaltung-natalie-frank.de";
    $subject = "Neue Anfrage von $name";
    
    $boundary = md5(time());
    $headers = "From: $name <$email>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $email_content = "--$boundary\r\n";
    $email_content .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
    $email_content .= "Name: $name\n";
    $email_content .= "E-Mail: $email\n\n";
    $email_content .= "Nachricht:\n$message\n";

    if (isset($_FILES['attachment'])) {
        foreach ($_FILES['attachment']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['attachment']['name'][$key];
            $file_type = $_FILES['attachment']['type'][$key];
            $file_content = chunk_split(base64_encode(file_get_contents($tmp_name)));

            $email_content .= "--$boundary\r\n";
            $email_content .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
            $email_content .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
            $email_content .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $email_content .= $file_content . "\r\n";
        }
    }

    $email_content .= "--$boundary--";

    if (mail($recipient, $subject, $email_content, $headers)) {
        echo "Vielen Dank! Ihre Nachricht wurde gesendet.";
    } else {
        echo "Hoppla! Beim Senden ist ein Fehler aufgetreten.";
    }
}
?>