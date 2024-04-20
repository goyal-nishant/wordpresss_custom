<?php
//Template Name: posts

if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
    
    // Redirect to the original WordPress post
    $post_url = "http://localhost/wordpress_dashbord/?p={$post_id}";
    header("Location: $post_url");
    exit;
} else {
    echo "<p>Post ID not specified.</p>";
}
?>
