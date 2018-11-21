<?php
function SendMail($to, $subject, $message) {
    $headers = 'From: info@viitriin.com' . "\r\n" .
        'Reply-To: info@viitriin.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}