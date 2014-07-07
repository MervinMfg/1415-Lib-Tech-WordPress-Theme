<?php
/*
Template Name: Environmental
*/
get_header();
?>
        <div class="bg2-top"></div>
        <section class="enviro-video bg2">
            <div class="section-content">
                <h1><?php the_title(); ?></h1>
                <div class="video-player">
                    <iframe src="http://player.vimeo.com/video/60610945?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
                <div class="video-copy">
                    <?php the_content(); ?>
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .tech-major -->
        <div class="bg3-top"></div>
        <section class="enviro-content bg3">
            <div class="section-content">
                <ul class="enviro-bullets">
                    <li><strong>We use non-petroleum based bio-plastics made from castor beans.</strong> Beans are a magical fruit!</li>
                    <li><strong>We DON'T use any cancer-causing toxic automotive lacquer clearcoats.</strong> Cancer can result in death! You don’t have to support companies that use toxic printing systems.</li>
                    <li><strong>We use soy-based elastomer sidewalls instead of toxic ABS.</strong></li>
                    <li><strong>We use only low VOC (Volatile Organic Compound) epoxy resin systems.</strong></li>
                    <li><strong>Our basalt fiber is additive-free &amp; less toxic than conventional fiberglass.</strong></li>
                    <li><strong>We use water-cleansed grinding systems to minimize airborne particulate levels.</strong> Pets are encouraged to stay out of the grinding areas.</li>
                    <li><strong>We use only renewable forest products for our cores. Columbian Gold is FSC "pure" certified.</strong> Fast growing trees have long fibers &amp; natural pop. Wood is nature's fiberglass!</li>
                    <li><strong>Our wood sawdust is recycled as a soil additive and scrap wood is donated as kindling.</strong></li>
                    <li><strong>We recycle all our scrap plastics (base cutouts, etc.)!</strong></li>
                    <li><strong>Our factory heating runs on renewable based biodiesel!</strong></li>
                </ul>
                <div class="enviro-more">
                    <img alt="Norm Eco-Sub Printing" src="<?php bloginfo('template_directory'); ?>/_/img/environmental-eco-sub-printing.jpg" width="397" height="270" />
                    <h3>ECO-SUB PRINTING!</h3>
                    <p>Mervin uses an environmentally friendly water-based ink sublimation graphics system to print all our snowboard graphics! (As opposed to the majority of the snowboard industry, which uses toxic solvent-based silkscreen inks with thick solvent-based gloss curtain coats on top... the process of building boards that way is very toxic for both the environment and people working in the factory, and because of the toxic inks, other company's scrap plastics are not recyclable.)</p>
                    <img alt="enviro-finger-joining" src="<?php bloginfo('template_directory'); ?>/_/img/environmental-finger-joining.jpg" width="397" height="270" />
                    <h3>FINGER JOINING!</h3>
                    <p>SIZE DOESN'T MATTER! Mervin does not waste odd sized wood. Using our finger joiner, Mervin is able to use normally unusable "cutoff end" wood core pieces. The wood is actually stronger at the joint than regular wood. The result is that almost no wood is wasted and the boards are stronger and have more pop.</p>
                    <img alt="Eco Woodcores" src="<?php bloginfo('template_directory'); ?>/_/img/environmental-eco-woodcores.jpg" width="397" height="270" />
                    <h3>ECO WOODCORES!</h3>
                    <p>We use fast growing framed eco woodcores. Good wood dust is collected so it can be recycled as soil additive. Scrap wood is donated as kindling.</p>
                </div>
                <div class="enviro-norm">
                    <img alt="Norm and a POP Box" src="<?php bloginfo('template_directory'); ?>/_/img/environmental-norm-pop-box.png" width="500" height="734" />
                </div>
                <div class="clearfix"></div>
            </div><!-- END .section-content -->
        </section><!-- END .tech-minor -->
<?php get_footer(); ?>