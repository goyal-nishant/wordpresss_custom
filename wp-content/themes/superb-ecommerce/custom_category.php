<?php

session_start();
define('WP_USE_THEMES', false);
require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');
echo "<title>Category</title>";

get_header();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashbordproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

$query = "SELECT wp_terms.term_id, wp_terms.name, wp_term_taxonomy.parent
          FROM wp_terms 
          INNER JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id 
          WHERE wp_term_taxonomy.taxonomy = 'category'";
$sql_run = mysqli_query($conn, $query);

// $fetch_query = "
//     SELECT 
//         t1.name AS category_name, 
//         t1.term_id AS category_id,
//         tt1.description AS category_description, 
//         GROUP_CONCAT(p.post_title SEPARATOR ', ') AS related_posts,
//         GROUP_CONCAT(p.post_name SEPARATOR ', ') AS post_slugs,
//         GROUP_CONCAT(p.post_date SEPARATOR ', ') AS post_dates,
//         t2.name AS parent_category
//     FROM 
//         wp_terms t1
//     LEFT JOIN 
//         wp_term_taxonomy tt1 ON t1.term_id = tt1.term_id 
//     LEFT JOIN 
//         wp_term_taxonomy tt2 ON tt1.parent = tt2.term_taxonomy_id
//     LEFT JOIN 
//         wp_terms t2 ON tt2.term_id = t2.term_id 
//     LEFT JOIN 
//         wp_term_relationships tr ON tt1.term_taxonomy_id = tr.term_taxonomy_id 
//     LEFT JOIN 
//         wp_posts p ON tr.object_id = p.ID 
//     WHERE 
//         tt1.taxonomy = 'category' 
//     GROUP BY 
//         t1.term_id 
//     ORDER BY 
//         tt1.parent, 
//         t1.name";

// $fetch_query_run = mysqli_query($conn, $fetch_query);
// if (!$fetch_query_run) {
//     die("Error executing query: " . mysqli_error($conn));
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .category-row {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
        }

        .category {
            width: 50%;
            padding: 10px;
        }

        .category a {
            text-decoration: none;
            color: #333;
        }

        .category a:hover {
            color: #666;
        }


        .container {
            flex: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }


        .footer {
            margin-top: auto;
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        .category-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .category {
            width: 48%;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .parent-category {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .child-category {
            padding-left: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #f8f9fa;
            padding: 10px 0;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 style="text-align: center;">Categories</h2>
        </div>
        <?php
        $categories = array();
        while ($fetch_assoc = mysqli_fetch_assoc($sql_run)) {
            $category_id = $fetch_assoc['term_id'];
            $category_name = $fetch_assoc['name'];
            $parent_id = $fetch_assoc['parent'];
            $categories[$parent_id][$category_id] = $category_name;
        }

        function buildCategoryList($categories, $parent_id = 0)
        {
            if (isset($categories[$parent_id])) {
                echo "<div class='container'>";
                echo '<div class="category-row">';
                foreach ($categories[$parent_id] as $category_id => $category_name) {
                    echo '<div class="category">';
                    echo '<a href="category_posts.php?category=' . $category_name . '">' . $category_name . '</a>';
                    buildCategoryList($categories, $category_id);
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
        }
        buildCategoryList($categories);
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php get_footer(); ?>

</body>

</html>