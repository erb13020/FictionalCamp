<?php

get_header();
while(have_posts()) {
    the_post(); ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/banner.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <div class="page-banner__intro">

            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('counselor'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Our Staff</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="container container--narrow page-section">

    <?php
    $image = get_field('counselor_picture');
    $size = 'large'; // (thumbnail, medium, large, full or custom size)
    ?>
    <div class="u-dif">
        <a href="<?php the_permalink(); ?>" class="u-tdn"><p class="counselor_name u-mts u-tdn"><?php the_title();
                ?></p></a>


        <?php
        $likeCount = new WP_Query(array(
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_counselor_id',
                    'compare' => '=',
                    'value' => get_the_ID()
                )
            )
        ));
        if ( is_user_logged_in() ) {
            $existQuery = new WP_Query(array(
                'author' => get_current_user_id(),
                'post_type' => 'like',
                'meta_query' => array(
                    array(
                        'key' => 'liked_counselor_id',
                        'compare' => '=',
                        'value' => get_the_ID()
                    )
                )
            ));
        }
        if ($existQuery->found_posts) {
            $state = 'liked';
        } else {
            $state = 'unliked';
        }

        $likeID = $existQuery->posts[0]->ID;
        ?>
        <span class="like-box" data-like="<?php $likeID ?>" data-counselor="<?php the_ID(); ?>" data-exists="<?php echo $state ?>">
            <i id="heart" class="<?php if ($state == 'liked') { echo 'fa fa-heart';} else {echo 'fa fa-heart-o';}?>" data-exists="yes" aria-hidden="true"></i>
            <span class="like-count" ><?php echo $likeCount->found_posts;?></span>
        </span>

    </div>
    <?php
    if( $image ) {
        ?>
        <div class="u-mf"><a href="<?php the_permalink(); ?>"><div class="counselor_img">
                    <?php echo wp_get_attachment_image( $image, $size );?>
                </div></a><div>
                <?php
                $attribute = get_field('counselor_city');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">City:</p><p><?php the_field('counselor_city')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_hometown');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Hometown:</p><p><?php the_field('counselor_hometown')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_activity');
                $content = get_the_content();
                if( ($attribute != '') AND ($content == '') ){ ?>
                    <div class="u-df"><p class="counselor_attribute">Activity:</p><p><?php the_field('counselor_activity')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_occupation');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Occupation:</p><p><?php the_field('counselor_occupation')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_school');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">School:</p><p><?php the_field('counselor_school')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_major');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Major:</p><p><?php the_field('counselor_major')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_career');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Career:</p><p><?php the_field('counselor_career')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_years_at_camp');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Years at Camp:</p><p><?php the_field('counselor_years_at_camp')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_hobbies');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Hobbies:</p><p><?php the_field('counselor_hobbies')?></p></div>
                <?php }; ?>

                <?php
                $attribute = get_field('counselor_favorite_food');
                if($attribute != ''){ ?>
                    <div class="u-df"><p class="counselor_attribute">Favorite Food:</p><p><?php the_field('counselor_favorite_food')?></p></div>
                <?php }; ?>
            </div>
            <div><?php the_content(); ?></div>
        </div>
        <?php
        $attribute = get_field('counselor_favorite_thing_about_camp');
        if($attribute != ''){ ?>
            <div class="u-db u-mtt"><p class="counselor_attribute">Favorite Thing About Camp:</p><p><?php the_field('counselor_favorite_thing_about_camp')?></p></div>
        <?php }; ?>

        <?php
        $attribute = get_field('counselor_favorite_camp_memory');
        if($attribute != ''){ ?>
            <div class="u-db u-mtt"><p class="counselor_attribute">Favorite Memory:</p><p><?php the_field('counselor_favorite_camp_memory')?></p></div>
        <?php }; ?>

        <?php
    } ?>

<?php }
echo paginate_links();
?>
    </div>

<?php
get_footer();
?>