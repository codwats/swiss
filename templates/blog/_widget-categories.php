<div class="c-sidebar-widget" data-scheme-target>
    <h3 class="c-sidebar-widget__title js-blog__sidebar-mobile">Categories</h3>
    <div class="c-sidebar-widget__content">
        
        <ul class="c-sidebar-ul">
            <?php echo wp_list_categories(
                    array(
                        'use_desc_for_title' => 0,
                        'title_li' => ''
                    )
                ); ?>
        </ul>

    </div>
</div>