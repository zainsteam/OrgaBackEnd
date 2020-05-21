<?php
    $email_to = "faiyazcool.alam@gmail.com";
    $email_subject = "Test mail";
    $email_body = "Hello! This is a simple email message.";


    if(mail($email_to, $email_subject, $email_body)){
        echo "The email($email_subject) was successfully sent.";
    } else {
        echo "The email($email_subject) was NOT sent.";
    }
?>