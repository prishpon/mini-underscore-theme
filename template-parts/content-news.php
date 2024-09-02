<?php
/**
 * Template part for displaying post type News
 *
 */

?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12">
           <?php _s_post_thumbnail(); ?>
           <div class="mt-5">
                <?php the_content(); ?>
           </div>
        </div>
  </div><!-- .row -->
</div><!-- .container -->    