<?php
function subscribe_link(){
    return 'Follow us on <a style="text-decoration:none;" href="https://www.youtube.com/";>youtube</a>';
    }
    add_shortcode('subscribe', 'subscribe_link');

?>