<?php
 if (is_active_sidebar('sidebar-1')) : 
 ?>
    <aside id="custom-widget-area" class="widget-area">
        <ul>
            <?php dynamic_sidebar('sidebar-1'); ?>
        </ul>
    </aside>
<?php endif; ?>
