<?php
  
  get_header();

  while(have_posts()) {
    the_post(); ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/banner.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          
        </div>
      </div>  
    </div>

    <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('activity'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Activities</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="u-mf">
      <div class="generic-content program-box"><?php the_field('activity_text'); ?></div>

      <div class="u-tac">
        <?php 
          $image = get_field('activity_picture');
          $size = 'large'; // (thumbnail, medium, large, full or custom size)
          if( $image ) {
            ?>
            <div><?php
              echo wp_get_attachment_image( $image, $size );
            ?>
          </div><?php
      } ?>

        <div class="embed-container u-mts u-tac">
          <?php the_field('activity_video'); ?>
        </div>
      </div>

    </div>

    <div class="generic-content u-mts"><?php the_content(); ?></div>

    <?php 
      $related_Counselors = get_field('related_counselors');

      if($related_Counselors != ''){
        ?> <h2 class="metatitle u-w100p"><?php the_title(); ?> Counselors</h2> <?php
        foreach($related_Counselors as $counselor) { ?>
          <div class="counselor_name u-mts u-db u-tdn"><a class="u-tdn" href="<?php echo get_the_permalink($counselor); ?>"><?php echo get_the_title($counselor)?></a></div>

        <?php }
      }
    ?>
    


    
  <?php }

  get_footer();

?>