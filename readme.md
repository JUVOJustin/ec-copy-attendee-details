# Events Calendar Attendee Details Copy

This small script saves the attendee details of the first attendee in a session and puts these details in the checkout form of woocommerce. This allows a faster checkout process for customers.

## Getting Started

The script is ready to use if your attendee form fields have the xact same name. If not you need to customize these.

## Prerequisites

The script works as a small wordpress plugin. It is written for **The Events Calender** in combination with **woocommerce**.

- WordPress: 'https://wordpress.org/'
- The Events Calender: 'https://theeventscalendar.com/'
- WWooCommerce: 'https://woocommerce.com/'


## Installing

You can either directly download the plugin as .zip 'https://github.com/JUVOWebDes/ec-copy-attendee-details/archive/master.zip' or customize the fields names.
If it is necessary to make adjustments you should create a copy and edit the code.

1. Copy script
2. Go into the code and serach the `<script>` tag
3. Edit the `jQuery( 'input[name*="email"]' ).val(data["email"]);` lines to meet your needs
4. Remove or add these as often as necessary to copy all the details from your form
5. Save and zip the file
6. Upload
7. Have fun
