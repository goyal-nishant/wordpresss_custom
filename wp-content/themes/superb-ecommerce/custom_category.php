<?php
//Template Name: category 

session_start();
// Todo: use: __DIR__
// practice require with different folder

// Enqueue Scripts/Styles fils
// Wordrpess Theme

require_once(__DIR__ . '/../../../wp-load.php');
function buildCategoryList($categories, $parent_id = 0)
{
    global $wpdb;

    $child_categories = $wpdb->get_results(
        $wpdb->prepare(
            "
                        SELECT wp_terms.term_id, wp_terms.name, wp_term_taxonomy.parent
                        FROM {$wpdb->terms} wp_terms
                        INNER JOIN {$wpdb->term_taxonomy} wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id 
                        WHERE wp_term_taxonomy.taxonomy = 'category' AND wp_term_taxonomy.parent = %d
                        ",
            $parent_id
        )
    );

    if ($child_categories) {
        foreach ($child_categories as $category) {
            echo '<div class="category">';
            echo '<a href="category_posts.php?category=' . $category->name . '">' . $category->name . '</a>';
            buildCategoryList($categories, $category->term_id);
            echo '</div>';
        }
    }
}

get_header();
// wp_list_categories();
// wp_dropdown_categories() ;
//  wp_terms_checklist();

$categories = get_categories();
// if ($categories) {
//     foreach ($categories as $category) {
//         echo '<input type="checkbox" id="category-' . $category->term_id . '" name="categories[]" value="' . $category->term_id . '">';
//         echo '<label for="category-' . $category->term_id . '">' . $category->name . '</label><br>';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
            width: calc(50% - 25px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 5px;
        }

        .category a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
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

        .card {
            background-color: #f8f9fa;
            padding: 10px 0;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 style="text-align: center;">Categories</h2>
        </div>
        <div class="category-row">
            <?php



            buildCategoryList($categories);
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php get_footer(); ?>

</body>

</html>