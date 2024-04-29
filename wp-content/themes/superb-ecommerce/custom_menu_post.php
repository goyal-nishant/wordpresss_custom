<?php
$query = $args['query'];
$paged = $args['paged'];

if ($query->have_posts()) :
?>
    <div class="custom-admin-wrap">
        <h1>All Posts</h1>
        <div class="dropdown-container">
            <label class="dropdown-label" for="postsPerPage">Posts Per Page: <?= $query->post_count; ?></label>
            <select id="postsPerPage" class="dropdown-select" onchange="updatePostsPerPage()">
                <option value="2" <?php if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 2) echo ' selected'; ?>>2</option>
                <option value="4" <?php if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 4) echo ' selected'; ?>>4</option>
                <option value="8" <?php if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 8) echo ' selected'; ?>>8</option>
                <option value="12" <?php if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 12) echo ' selected'; ?>>12</option>
            </select>
        </div>

        <table class=" custom-admin-table widefat fixed striped">
            <thead>
                <tr>
                    <th class="custom-admin-feature-image">Featured Image</th>
                    <th class="custom-admin-title">Title</th>
                    <th class="manage-column">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <tr>
                        <td>
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" class="custom-admin-image" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <?php else : ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                        <td><?php the_excerpt(); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="custom-admin-pagination">
            <?php echo paginate_links(array(
                'total'   => $query->max_num_pages,
                'current' => $paged,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            )); ?>
        </div>
        <div><?= "posts per page: " . $query->post_count; ?></div>
    </div>
<?php
    wp_reset_postdata();
else :
?>
    <div class="custom-admin-wrap">
        <h1>All Posts</h1>
        <p>No posts found.</p>
    </div>
<?php
endif;
?>

<script>
    function updatePostsPerPage() {
        var postsPerPage = document.getElementById("postsPerPage").value;
        // Update the URL with the selected posts_per_page parameter
        var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        url.searchParams.set('posts_per_page', postsPerPage);
        window.location.href = url.toString();
    }
</script>