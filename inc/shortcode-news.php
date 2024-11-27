<?php
/**
 * Creating shortcode for displaying post type 'News' with custom quantity of posts to show and category
 * Shortcode to add on the  [news category='Posts category' posts_per_page='5']
 */

function drums_news_category($atts='') {

    $default = array(
        'category' => '',  //default value of shortcode parameter 'category'
        'posts_per_page' =>  3 //default quantity for posts to show 
    );
    $a = shortcode_atts($default, $atts); //passing default shortcode attributes to variable a

    $cat = $a[ 'category' ]; //passing value from array with shortcode parameters to variable $cat
    $quantity = $a['posts_per_page']; //passing value from array with shortcode parameters to variable $quantity

     $args = array(     //setting arguments for passing to query for displaying posts
            'post_type' => 'news',
            'posts_per_page' => $quantity,
            'tax_query' => array(
                array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $cat
                )
            )
   ); ?> 
                                                 
<?php $the_query = new WP_Query($args); 
      $post_id = get_the_ID();
?> 
  
<div class="container ">  
 <?php if ( $the_query->have_posts() ) : ?>

        <?php  while ( $the_query->have_posts() ) : $the_query->the_post(); //Start loop for displaying cpt news in a shortcode?>
                    <div class="card d-flex flex-md-row flex-sm-column mb-5 p-3">
                        <div class="d-md-none">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                        </div><!-- .mobile title wrap -->
                        <div class="col-md-4" >
                            <?php if ( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'post-thumbnail', [ 
                                                                'class' => 'img-fluid rounded-start',//adding bootsrap class to thumbnail image
                                                                'title' => 'Feature image',
                                        ] ); 
                                    } ?>
                        </div> <!-- .featured img wrap -->
                        <div class="col-md-8 card-body align-items-center">
                            <div class="d-sm-none">
                                <h2 class="card-title"><?php the_title(); ?></h2>
                            </div><!-- .desktop title wrap -->

                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <div class="d-flex justify-content-md-end">
                                <a href="<?php echo get_permalink(); ?>" class="btn btn-primary text-light">Read
                                    more</a>
                            </div><!-- .button wrap -->
                        </div><!-- .card-body wrap -->
                    </div><!-- .card -->
                <?php  endwhile;  ?><!-- end of loop -->

 <?php  endif; ?>
 </div><!-- .container -->   


//Shortcode for displaying custom query with ebooks

function xamin_books() {
	$buffer = '<div class="ebook-grid">';
  
		$q = new WP_Query(array(
			'post_type' => 'book',
			'posts_per_page' => 5
		));

while ($q->have_posts()) {
	      $q->the_post();

	  $buffer .= '<div class="ebook-card">';

         $buffer .= '<div class="wpb_single_image"><img src=';  
         $buffer .= get_field('book_image');  
         $buffer .= '>';  
    
         $buffer .= '<h2>'.get_the_title().'</h2><p>';
         $buffer .= get_field('book_description');
        
        $buffer .= '</p></div><div><a href=';  
        $buffer .= get_field('download_file');  
        $buffer .= ' target="_blank" download>Download File</a>'; 
        $buffer .= '</div></div>';
 
    }

wp_reset_postdata();
  
$buffer .= '</div>';

return $buffer;

}

add_shortcode('books', 'xamin_books');
     
 <?php 
}

 add_shortcode('news', 'drums_news_category');
