<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "marufahmed@u.boisestate.edu";
    $email_subject = "Contact from marufahmed.us";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Phone']) ||
        !isset($_POST['Message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $Name = $_POST['Name']; // required
    $Email = $_POST['Email']; // required
    $Phone = $_POST['Phone']; // required
    $Message = $_POST['Message']; // not required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$Email)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$Name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($Message) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    $email_message .= "Name: ".clean_string($Name)."\n";
    $email_message .= "Email: ".clean_string($Email)."\n";
    $email_message .= "Phone: ".clean_string($Phone)."\n";
    $email_message .= "Message: ".clean_string($Message)."\n";

// create email headers
    $headers = 'From: '.$Email."\r\n".
        'Reply-To: '.$Email."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    ?>

    <!-- include your own success html here -->

    <p> Thank you for contacting Me. I will be in touch with you very soon! </p>

    <?php

}
?>