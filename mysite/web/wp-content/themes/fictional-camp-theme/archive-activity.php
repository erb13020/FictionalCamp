<?php

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/banner.jpg') ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">All Activities</h1>
    <div class="page-banner__intro">
      <p>If its an activity, we have it</p>
    </div>
  </div>  
</div>

<div class="container container--narrow page-section">

    <div class="generic-content">
      <?php $id=72; $post = get_page($id); echo $post->post_content;  ?>
    </div>

<div class="container container--narrow page-section flex-grid">
    <?php
  while(have_posts()) {
    the_post(); ?>
    	 <?php 
          $image = get_field('activity_picture');
          $size = 'large'; // (thumbnail, medium, large, full or custom size)
          if( $image ) {
            ?>
            <div class="col-third">
            <div class="u-dib">
            	<div class="activity-thumb"><a href="<?php the_permalink(); ?>"><?php
              echo wp_get_attachment_image( $image, $size );
            ?>	</a></div>
        <h5 class="activity-summary__title headline headline--tiny u-tac u-mtt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          </div></div><?php
     	 } ?>
  <?php }
  echo paginate_links();
?>
</div>



</div>

<?php get_footer();

?>