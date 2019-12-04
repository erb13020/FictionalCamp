<?php

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/banner.jpg') ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">All Programs</h1>
    <div class="page-banner__intro">
      <p>We have a program for your child</p>
    </div>
  </div>  
</div>

<div class="container container--narrow page-section">

    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>">Our Programs</a></h2>
      <ul class="min-list">
        <?php
          while(have_posts()) {
            the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
          <?php }
          echo paginate_links();
        ?>
      </ul>
    </div>

    <div class="generic-content">
      <?php $id=23; $post = get_page($id); echo $post->post_content;  ?>
    </div>

</div>

<?php get_footer();

?>