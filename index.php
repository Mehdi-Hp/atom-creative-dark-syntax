<!doctype html>
<html lang="fa">
<head>
   <?php include(TEMPLATEPATH . '/head.php'); ?>

   <title>
      <?php bloginfo('name'); ?>
   </title>
</head>

<body>
   <?php include(TEMPLATEPATH . '/header.php'); ?>

   <section class="introduce">
      <div class="introduce-cover">
         <script>
            var viewport = {
               width  : $(window).width(),
               height : $(window).height()
            };
            if ( viewport.width > 1366 ) {
               $('.introduce-cover').append('<?php echo types_render_field("introduce-cover-desktop",null); ?>');
            }
            if ( viewport.width > 880 && viewport.width <= 1366 ) {
               $('.introduce-cover').append('<?php echo types_render_field("introduce-cover-desktop",null); ?>');
            }
            if ( viewport.width > 500 && viewport.width <= 880 ) {
               $('.introduce-cover').append('<?php echo types_render_field("introduce-cover-tablet",null); ?>');
            }
            if ( viewport.width <= 500 ) {
               $('.introduce-cover').append('<?php echo types_render_field("introduce-cover-mobile",null); ?>');
            }
         </script>

         <a href="<?php echo get_permalink(types_render_field("month-product-article",null)); ?>" class="month-product"><?php echo types_render_field("month-product",null); ?></a>

         <div class="with-notes-from">
            <?php echo types_render_field("with-notes-from",null); ?>
         </div>

         <div class="publish-number">
            <span class="persiaNumber"><?php echo types_render_field("publish-number-by-numbers",null); ?></span>
         </div>
      </div>
      <div class="with-notes-from-2"><?php echo types_render_field("with-notes-from",null); ?></div>
   </section>

<?php $args = array (
'post_type'              => 'new-publish',
'posts_per_page'         => '1',
);
$query = new WP_Query( $args );
while ( $query->have_posts() ) : $query->the_post(); ?>
<?php $rec_count = count(get_post_meta($post->ID, 'wpcf-rec-article'))-1; ?>
<?php $rec_article_id_array = array(); ?>
<?php for ( $counter=0; $counter<=$rec_count; $counter++ ) {
   $rec_article_array[] = types_render_field("rec-article", array("index" => $counter));
} ?>
<?php $first_case = types_render_field("first-case",null); ?>
<?php $second_case = types_render_field("second-case",null); ?>


<section class="catalogs">
   <h2 data-icon="d">
      <span>فهرست</span>
   </h2>
   <?php $custom_publish_number = $latest_publish_number; ?>
   <?php include(TEMPLATEPATH . '/catalog.php'); ?>

   <script>
   $(".catalogs > h2").on("click",function () {
      $(".catalog-holder").toggleClass("catalog-holder-show");
   });
   </script>
</section>

<div class="regular-ads">
   <div class="regular-ad-right"></div>
   <div class="regular-ad-left"></div>
</div>

<section class="articles" id="articles-special-cases">
   <h2 data-icon="j">پرونده ویژه</h2>
   <div class="article-holder-outer">
      <?php
      $custom_args = array (
      'p'         => $first_case,
      'post_type' => array('entrance', 'month-report', 'managers-club', 'service-and-trace', 'library', 'solution', 'world')
      );
      $custom_query = new WP_Query( $custom_args );
      if ( $custom_query->have_posts() ) {
         while ( $custom_query->have_posts() ) : $custom_query->the_post();
         ++$post_counter;
         ?>
         <?php include(TEMPLATEPATH . '/article_box.php'); ?>
      <?php endwhile; ?>
      <?php } ?>
      <?php wp_reset_postdata(); ?>

      <?php
      $custom_args = array (
      'p'         => $second_case,
      'post_type' => array('entrance', 'month-report', 'managers-club', 'service-and-trace', 'library', 'solution', 'world')
      );
      $custom_query = new WP_Query( $custom_args );
      if ( $custom_query->have_posts() ) {
         while ( $custom_query->have_posts() ) : $custom_query->the_post();
         ++$post_counter;
         ?>
         <?php include(TEMPLATEPATH . '/article_box.php'); ?>
      <?php endwhile; ?>
      <?php } ?>
      <?php wp_reset_postdata(); ?>
   </div>

   <script>
   $("#articles-special-cases > h2").on("click",function () {
      $("#articles-special-cases > .article-holder-outer").toggleClass("article-holder-outer-show");
   });
   </script>
</section>

<div class="regular-ads">
   <div class="regular-ad-right"></div>
   <div class="regular-ad-left"></div>
</div>

<section class="articles" id="articles-rec-articles">
   <h2 data-icon="p">مطالب پیشنهادی</h2>
   <div class="article-holder-outer">
      <?php for ( $counter=0; $counter<=$rec_count; $counter++ ) { ?>
         <?php $custom_args = array (
         'p'         => $rec_article_array[$counter],
         'post_type' => array('entrance', 'month-report', 'managers-club', 'service-and-trace', 'library', 'solution', 'world')
         );
         $custom_query = new WP_Query( $custom_args );
         if ( $custom_query->have_posts() ) {
            while ( $custom_query->have_posts() ) : $custom_query->the_post();
            ++$post_counter; ?>
            <?php include(TEMPLATEPATH . '/article_box.php'); ?>
         <?php endwhile; ?>
         <?php } ?>
         <?php wp_reset_postdata(); ?>
         <?php } ?>
      </div>

      <script>
      $("#articles-rec-articles > h2").on("click",function () {
         $("#articles-rec-articles > .article-holder-outer").toggleClass("article-holder-outer-show");
      });
      </script>
   </section>

   <div class="regular-ads">
      <div class="regular-ad-right"></div>
      <div class="regular-ad-left"></div>
   </div>

<?php endwhile;?>
<?php wp_reset_postdata(); ?>

<?php include(TEMPLATEPATH . '/footer.php'); ?>


</body>

</html>
