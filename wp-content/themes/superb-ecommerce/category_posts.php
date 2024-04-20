<?php
//Template Name: category posts
session_start();

define('WP_USE_THEMES', false);
require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');


get_header();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashbordproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $fetch_posts_query = "
    SELECT 
        p.*, 
        (SELECT meta_value FROM wp_postmeta WHERE post_id = p.ID AND meta_key = '_thumbnail_id') AS featured_image_id,
        (SELECT guid FROM wp_posts WHERE ID = (SELECT meta_value FROM wp_postmeta WHERE post_id = p.ID AND meta_key = '_thumbnail_id')) AS featured_image_url
    FROM 
        wp_posts p
    JOIN 
        wp_term_relationships tr ON p.ID = tr.object_id
    JOIN 
        wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    JOIN 
        wp_terms t ON tt.term_id = t.term_id
    WHERE 
        t.name = '$category' 
        AND p.post_type = 'post' 
        AND p.post_status = 'publish'
";

    $fetch_posts_query_run = mysqli_query($conn, $fetch_posts_query);

    if (!$fetch_posts_query_run) {
        die("Error executing query: " . mysqli_error($conn));
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category; ?> Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }


        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        .post-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .post-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .post-card .post-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post-card .post-excerpt {
            color: #666;
            line-height: 1.5;
        }

        .post-card a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 10px;
        }

        .post-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?php echo $category; ?> Posts</h1>
        <?php
        if (mysqli_num_rows($fetch_posts_query_run) > 0) {
            while ($post_data = mysqli_fetch_assoc($fetch_posts_query_run)) {
                echo "<div class='post-card'>";
                echo "<a href='post.php?id={$post_data['ID']}'><img src='{$post_data['featured_image_url']}' style = 'height:500px' alt='{$post_data['post_title']}' /></a>";
                echo "<div class='post-title'>{$post_data['post_title']}</div>";
                echo "<div class='post-excerpt'>" . substr($post_data['post_content'], 0, 150) . "...</div>";
                echo "<a href='post.php?id={$post_data['ID']}'>Read more</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No posts found for this category.</p>";
        }
        ?>
    </div>
    <?php get_footer(); ?>
</body>

</html>