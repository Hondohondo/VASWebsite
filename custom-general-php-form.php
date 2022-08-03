<p>
    This file is a PHP file; please change the filename to contact-form.php before you upload it to your web server in order for it to work.
    This file is open source, provided by the developers of ITCN NJ Web Design and Marketing, http://www.itcn.com<br />
    Version 1.0, April 2008
</p>

<p>
    PAGE HEADER CONTENT
</p>

<p>
    Put whatever webpage content you want before the form here.
</p>


<?php

// THIS IS THE EMAIL ADDRESS ALL THE EMAILS SENT FROM THE CONTACT FORM WILL BE COMING FROM
$yourFromEmail = "fromyou@domain.com";

// THIS IS THE EMAIL ADDRESS YOU WANT THE COMPLETED CONTACT FORM TO BE EMAILED TO
$yourToEmail = "goingtoyou@domain.com";


switch ($_REQUEST["mode"]) {
    case "submit":
        // THIS PROCESSES THE FORM INPUT
        processForm();
        break;

    default:
        // THIS DISPLAYS THE HTML FORM
        displayForm();
        break;
}

?>

<p>
    PAGE FOOTER CONTENT
</p>

<p>
    Any content here will be displayed after the contact form.
</p>

<?php




function processForm() {
    global $yourFromEmail, $yourToEmail;

    // NO NEED TO EDIT ANY PHP IN THIS SECTION, IT WILL HANDLE ALL YOUR FORM INPUTS

    if(!empty($_REQUEST)){
        foreach($_REQUEST as $x => $y){
            $finalValue = $x;

            if (strstr($finalValue, "form_")) {
                if (strstr($finalValue, "form_req_")) {
                    // GET REQUIRED FIELDS

                    $finalValue = str_replace("form_req_", "", $finalValue);
                    $finalValue = str_replace("_", " ", $finalValue);

                    if (strlen($y) < 1) {

                        $formError .= "<li>The <strong>$finalValue</strong> field is required.";
                    } else {
                        $finalResult .= "<li>$finalValue: $y</li>\n";
                    }
                } else {
                    if (is_array($y)) {
                        // BUILD ARRAY FOR RADIOBUTTONS

                        $finalResult .= "<li>$finalValue: ";

                        foreach($y as $arrayValues) {
                            $finalResult .= $arrayValues . ", ";
                        }

                        $finalResult .= "</li>\n";

                    } else {
                        $finalValue = str_replace("form_", "", $finalValue);
                        $finalValue = str_replace("_", " ", $finalValue);

                        $finalResult .= "<li>$finalValue: $y</li>\n";
                    }
                }
            }
        }
    }

    if (strlen($formError) < 1 && strlen($finalResult) > 1) {

        // THIS IS THE ACTUAL EMAIL CODE, YOU MAY CUSTOMIZE THIS IF YOU WISH

        $mailheaders = "MIME-Version: 1.0\r\n";
        $mailheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $mailheaders .= "X-Originating-IP: " . gethostbyname(getenv("REMOTE_ADDR")) . "\r\n";
        $mailheaders .= "From: $yourFromEmail\r\n";

        $mailBody = "<ul>\n";
        $mailBody .= $finalResult;
        $mailBody .= "</ul>\n";
        $mailBody .= "<p>This form was submitted from the website.</p>\n";

        // NOW ACTUALLY SEND OUT THE EMAIL
        mail($yourToEmail, "Your Website Contact Form Submission", $mailBody, $mailheaders);


        $mailheaders = "MIME-Version: 1.0\r\n";
        $mailheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $mailheaders .= "X-Originating-IP: " . gethostbyname(getenv("REMOTE_ADDR")) . "\r\n";
        $mailheaders .= "From: $yourFromEmail\r\n";

        $mailBody = "<p>Thank you. A website representative will be in touch with you shortly. Thank you for contacting us.</p>";

        // THIS WILL SEND AN EMAIL TO THE USER, LETTING THEM KNOW THAT THEIR FORM WAS SUCCESSFULLY SUBMITTED
        mail($_REQUEST["form_req_Email"], "Website Contact Us Form Submission", $mailBody, $mailheaders);


        displayThanks();


    } else {

        echo "<p>Sorry, but your form has the following errors: " . $formError . "</p>";
        displayForm();

    }
}


function displayThanks() {

    echo "<p>Thank you, " . $_REQUEST["form_req_Name"] . ", your form has been submitted and your request will be answered as soon as possible.</p>";

}


function displayForm() {

    // THIS IS THE ACTUAL HTML DISPLAY FORM.  ADD AS MANY FORM ELEMENTS HERE AS YOU WISH, THEY WILL BE HANDLED AUTOMATICALLY

    ?>

    <form action="contact-form.php" method="post">
        <p>
            Name: <input type="text" name="form_req_Name" value="<?=$_REQUEST["form_req_Name"]?>" />
        </p>

        <p>
            Phone Number: <input type="text" name="form_Phone" value="<?=$_REQUEST["form_Phone"]?>" />
        </p>

        <p>
            Email Address: <input type="text" name="form_req_Email_Address" value="<?=$_REQUEST["form_req_Email_Address"]?>" />
        </p>

        <p>
            Preferred Method of Contact: <br />
            <input type="radio" name="form_Preferred_Method_of_Contact" value="Email" checked="checked" /> Email<br />
            <input type="radio" name="form_Preferred_Method_of_Contact" value="Phone" /> Phone
        </p>

        <p>
            <input type="hidden" name="mode" value="submit" />
            <input type="submit" name="Submit" value="Submit" />
        </p>
    </form>


    <?php
}
?>

