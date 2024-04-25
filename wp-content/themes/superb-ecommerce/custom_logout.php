<?php

function custom_logout_process() {
    // Log the user out
    wp_logout();

    // Redirect to the WordPress login page
    wp_redirect(wp_login_url());
    exit;
}

// Call the custom logout process
custom_logout_process();

?>