<?php
/**
* Plugin Name: JUVO Events Calendar Attendee Details Copy
* Description:  This plugin copies the details of the first attendee to the checkout screen
* Version:      1.0.0
* Author: JUVO Webdesign
* Author URI: http://juvo-design.de/
*/

add_action( 'woocommerce_before_checkout_form', 'juvo_woocommerce_attendee_details_copy');
 function juvo_woocommerce_attendee_details_copy() {
    
    //Needed to access session
    session_start();
    
    //Check if session variable is available
    if(isset($_SESSION['juvo-attendee-data'])) {

        //Create html buffer
        ob_start("callback");

        ?>

        <script>
            var data = <?php echo $_SESSION['juvo-attendee-data'] ?>;
            jQuery(document).ready(function(){ 
                jQuery( 'input[name*="first_name"]' ).val(data["vorname"]);
                jQuery( 'input[name*="last_name"]' ).val(data["name"]);
                jQuery( 'input[name*="company"]' ).val(data["firma"]);
                jQuery( 'input[name*="billing_address_1"]' ).val(data["strasse-und-hausnummer"]);
                jQuery( 'input[name*="postcode"]' ).val(data["postleitzahl"]);
                jQuery( 'input[name*="city"]' ).val(data["ort"]);
                jQuery( 'input[name*="phone"]' ).val(data["telefon"]);
                jQuery( 'input[name*="email"]' ).val(data["email"]);
                //console.log(data);
            });
        </script>

        <?php

        //Output buffer
        echo ob_get_contents();
        //Clear buffer
        ob_end_flush();
    }
 }

//Check if Attende Information is submitted
if (isset($_POST['tribe_tickets_saving_attendees'])) {
    //Create Instance to get attendee details
    $obj = new AttendeeDetailsCopy;
    //Create Session to store data persistently
    session_name('juvo-woo-attendee-copy');
    session_start();

    //encode data for easy javascript access
    $data = json_encode($obj->data);

    //save data in session
    $_SESSION['juvo-attendee-data'] = $data;
}

class AttendeeDetailsCopy {
    public $data;

    function __construct() {
        $this->getInformation();
    }

    private function getInformation() {
        //Get Information
        $attendeesInformations = $_POST['tribe-tickets-meta'];
        $data;

        //Iterate through variable, necessary due to array structure -.-
        if (!empty($attendeesInformations)) {
            foreach ($attendeesInformations as $attendeesInformation) {
                //First Inner Elements is the current event
                if ($i == 0) {
                    //strore data of first attendee in first event
                    $this->data = $attendeesInformation[0];
                }
                $i++;
            }
        }
    }
}