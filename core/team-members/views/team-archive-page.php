<?php
defined( 'ABSPATH' ) || die();
get_header();
?>
<div class="wrapper">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="block"> 
    <?php include \Markutos::core_dir() . 'team-members/views/part.php'; ?>
  </div>
  <?php endwhile; ?>

  <div class="pagination">
    <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => 'Previous',
            'next_text' => 'Next',
        ) );
    ?>
  </div>
  <?php else : ?>
  <p><?php _e( 'Sorry, no posts matched your criteria.','markutos' ); ?></p>
  <?php endif; ?>
</div>
<?php
get_footer();