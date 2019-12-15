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
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>

    <div class="u-mf">
      <div class="generic-content program-box"><?php the_content(); ?></div>

      <div>
        <div class="u-tac">
          <div class="metatitle">Dates & Fees</div>
          <div class="metaitems">
            <div class="u-df metatext"><p class="u-mrt u-fw700">Dates: </p><p class="u-mrt"><?php the_field('date_start'); ?></p><p class="u-mrt"> to </p><p><?php the_field('date_end'); ?></p></div>
            <div class="u-df metatext"><p class="u-mrt u-fw700">Tuition: </p><p><?php the_field('program_fees'); ?></p></div>
          </div>
        </div>

        <?php 
          $image = get_field('program_picture');
          $size = 'large'; // (thumbnail, medium, large, full or custom size)
          if( $image ) {
            ?>
            <div class="u-tac"><?php
              echo wp_get_attachment_image( $image, $size );
            ?>
          </div><?php
      } ?>

        <div class="embed-container u-mts u-tac">
          <?php the_field('program_video'); ?>
        </div>
      </div>

    </div>

    <div class="review"><p><?php the_field('program_review'); ?></p></div>
    


    
  <?php }

  get_footer();

?>




