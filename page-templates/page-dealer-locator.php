<?php
/*
Template Name: Dealer Locator
*/
get_header();
?>
          <div class="bg2-top"></div>
          <section class="dealer-locator bg2">
               <div class="section-content">
                    <h1><?php the_title(); ?></h1>
                    <div class="dealer-copy">
                         <?php the_content(); ?>
                    </div>
                    <?php
                         $iFrameURL = 'http://hosted.where2getit.com/mervin/?LIBTECH=1';
                         // Check the current url and see if we need specific product filtering
                         if (isset($_GET["product"])) {
                              $product = $_GET["product"];
                              // check for products
                              if(strpos($product, 'waterboards') !== false) {
                                   $iFrameURL .= '&WATERBOARDS=1';
                              }
                              if(strpos($product, 'skateboards') !== false) {
                                   $iFrameURL .= '&SKATEBOARDS=1';
                              }
                              if(strpos($product, 'snowboards') !== false) {
                                   $iFrameURL .= '&SNOWBOARDS=1';
                              }
                              if(strpos($product, 'bindings') !== false) {
                                   $iFrameURL .= '&BINDINGS=1';
                              }
                              if(strpos($product, 'nas') !== false) {
                                   $iFrameURL .= '&NAS=1';
                              }
                              if(strpos($product, 'demo') !== false) {
                                   $iFrameURL .= '&DEMOCENTERS=1';
                              }
                         }
                    ?>
                    <iframe src="<?php echo $iFrameURL; ?>" frameborder="0" height="700" width="920" scrolling="no" >You need a Frames Capable browser to view this content.</iframe>
                    <div class="iframe-fallback">
                         <p><a href="/dealer-locator/map/" target="_blank" class="h4">View Dealer Map/Locator</a></p>
                         <p>Our locator does not work well within smaller browsers. Use the link above to view the stand-alone locator.</p>
                    </div>
               </div><!-- END .section-content -->
          </section><!-- END .dealer-locator -->

<?php get_footer(); ?>