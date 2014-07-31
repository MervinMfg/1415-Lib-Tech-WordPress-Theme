<?php
/*
Template Name: Dealer Locator
*/
get_header();
?>
          <div class="bg-product-details-top"></div>
          <section class="dealer-locator bg-product-details">
               <div class="section-content">
                    <h1><?php the_title(); ?></h1>
                    <div class="dealer-copy">
                         <?php the_content(); ?>
                    </div>
                    <?php
                         $iFrameURL = 'http://hosted.where2getit.com/mervin/index_responsive.html?LIBTECH=1';
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
                              if(strpos($product, 'fundamental') !== false) {
                                   $iFrameURL .= '&fundaMENTALS=1';
                              }
                              if(strpos($product, 'demo') !== false) {
                                   $iFrameURL .= '&DEMOCENTERS=1';
                              }
                         }
                    ?>
                    <iframe src="<?php echo $iFrameURL; ?>" frameborder="0" height="700" width="100%" scrolling="no" id="dealer-locator">You need a Frames Capable browser to view this content.</iframe>
                    <script type="text/javascript">
                         var iframe_id="dealer-locator";
                         var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                         var eventer = window[eventMethod];
                         var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
                         eventer(messageEvent,function(e) {
                              if(e.data.indexOf("w2gi:iframeHeightUpdated") !== -1) {
                                   var dimensions = e.data.split("//");
                                   autoResize(dimensions[1], dimensions[2]);
                              }
                              if(e.data.indexOf("w2gi:scrollPage") !== -1) {
                                   var offsets = document.getElementById(iframe_id).getBoundingClientRect();
                                   var values = e.data.split("//");
                                   var destination = values[1];
                                   var offset = values[2];
                                   window.scrollTo(0, destination + offsets.top);
                              }
                         },false);
                         function autoResize(newheight, newwidth){
                              document.getElementById(iframe_id).style.height= parseInt(newheight) + 40 + "px";
                         }
                    </script>
               </div><!-- END .section-content -->
          </section><!-- END .dealer-locator -->

<?php get_footer(); ?>