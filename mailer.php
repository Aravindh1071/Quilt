<?php
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL); 

        // Check that data was sent to the mailer.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "harikrishnan@q-u-i-l-t.com";
        $from_email = "harikrishnan@q-u-i-l-t.com"
        $name = "user";
        
        // Set the email subject.
        $subject = "User Data Deletion Request";

        // Build the email content.
        $email_content .= "User requested data deletion from Email: $email\n";

        // Build the email headers.
        $email_headers = "From: $name <$from_email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Thank You! Email sent successfully!']);
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'There was a problem with your submission, please try again later.']);
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'There was a problem with your submission, please try again later.']);
        //echo "There was a problem with your submission, please try again.";
    }

?>
