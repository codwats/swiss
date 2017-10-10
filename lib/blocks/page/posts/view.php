<section class="b-cards">

    <?php echo \Swiss\sprint('<div class="c-background-image" style="background-image:url(%s);"></div><div class="c-overlay"></div>', \Swiss\Acf\getImageUrl('large', $block->get('background_image'))); ?>

    <div class="b-cards__container b-cards__container--intro">

        <?php echo \Swiss\sprint('<div class="b-cards__intro"><div class="h-wysiwyg-html" data-scheme-target>%s</div></div>', $block->get('text')); ?>

    </div>

    <div class="b-cards__container">

        <?php if(!empty($block->get('posts'))): ?>

            <div class="l-cards" data-column-count="<?php echo sizeof($block->get('posts')); ?>">

            <?php global $post; foreach($block->get('posts') as $k => $post): setup_postdata($post); ?>

                <div class="l-cards__item">
                    <?php echo \Swiss\template(get_post_type().'/_card.php', $post); ?>
                </div>

            <?php endforeach; wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

    </div><!-- end of b-cards__container -->
</section><!-- end of b-cards -->
