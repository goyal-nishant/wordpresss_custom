<?php
//Template Name: all category posts
session_start();

// define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

get_header();

$category = $_GET['category'] ?? '';
//$paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 2, 
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    // 'tax_query'      => array(
    //     array(
    //         'taxonomy' => 'category',
    //         'field'    => 'slug',
    //         'terms'    => $category,
    //     ),
    // ),
);

$query = new WP_Query($args);

function view_posts($category,$query,$paged){
    echo paginate_links(array(
        'total'      => $query->max_num_pages,
        'current'    => get_query_var('paged') ? get_query_var('paged') : 1,
        'format'     => '?paged=%#%',
        'prev_next'  => true,
        'prev_text'  => __('« Previous'),
        'next_text'  => __('Next »'),
        'type'       => 'list',
        'add_args'   => array(
            'category' => $category,
        ),
    ));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category; ?> Posts</title>
</head>

<body>
    <div class="container">
        <h1><?php echo $category; ?> Posts</h1>
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <div class='post-card'> 
                    <a href='<?php the_permalink(); ?>'><img src='<?php echo get_the_post_thumbnail_url(); ?>' style='height:500px' alt='<?php the_title(); ?>' /></a>
                    <div class='post-title'><?php the_title(); ?></div>
                    <div class='post-excerpt'><?php the_excerpt(); ?></div>
                    <a href='<?php the_permalink(); ?>'>Read more</a>
                </div>
        <?php
            endwhile;
        ?>
            <div class="pagination">

                <?php
                  view_posts($category,$query,$paged);
                ?>
                
            </div>
        <?php
            wp_reset_postdata();
        else :
            echo "<p>No posts found for this category.</p>";
        endif;
        ?>
    </div>
    <?php get_footer(); ?>
</body>

</html>
