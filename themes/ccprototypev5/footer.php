            </main>

            <?php if(!is_front_page() && ($post->ID != 173) && !is_404()) { ?>

                <?php 
                    $footerctatitle = get_field('footer_cta_title');
                    $footerctatext = get_field('footer_cta_text');
                    $footerctabuttonlink = get_field('footer_cta_buttonlink');
                    $footerctabuttontext = get_field('footer_cta_buttontext');

                    if($footerctatitle || $footerctatext || $footerctabuttontext) { ?>

                <div id="footercta" class="row">
                    
                    <div class="container">

                        <?php 

                        if($footerctatitle) {

                            echo '<h2>' . $footerctatitle . '</h2>';

                        }

                        if($footerctatext) {

                            echo '<p>' . $footerctatext . '</p>';
                        }

                        if($footerctabuttontext) {

                            echo '<a class="button" href="' . $footerctabuttonlink . '">' . $footerctabuttontext . '</a>';
                        }

                        ?>

                    </div>

                </div>

                <?php } ?>

            <?php } ?>

            <footer id="footer" role="contentinfo">

                <div class="container">

                    <div class="row rel">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <!-- <a href="<?php bloginfo('url'); ?>">
                                <img class="logo" alt="<?php bloginfo('name'); ?>" src="<?php echo get_field('logo','option'); ?>" />
                            </a> -->
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <?php 

                                // $address = get_field('address','option');
                                // $phone = get_field('phone','option');
                                // $email = get_field('email','option');

                                // if($address) {
                                //     echo '<p><b>Mail Address:</b><br/>';
                                //     echo $address;
                                //     echo '</p>';
                                //     echo '<br/>';
                                // }

                                // if($phone) {
                                //     echo '<p class="phone"><b>Phone: </b><a href="tel:' . $phone . '">' . $phone . '</a></p>';
                                // }

                                // if($email) {
                                //     echo '<p class="email"><b>Email: </b><a href="mailto:' . $email . '">' . $email . '</a></p>';
                                // }

                            ?>

                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                            <?php

                            // $footerbuttonlink = get_field('footer_buttonlink','option');
                            // $footerbuttontext = get_field('footer_buttontext','option');

                            // if($footerbuttonlink) {
                            //     echo '<a class="button" href="' . $footerbuttonlink . '">' . $footerbuttontext . '</a>';
                            // }

                            ?>

                            <?php

                            // $facebook = get_field('facebook','option');
                            // $instagram = get_field('instagram','option');

                            // if($facebook || $instagram) {

                            // echo '<h4>Follow Us</h4>';

                            // echo '<div class="socialmedia">';

                            //     if($facebook) {
                            //         echo '<a target="_blank" href="' . $facebook . '"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
                            //     }

                            //     if($instagram) {
                            //         echo '<a target="_blank" href="' . $instagram . '"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
                            //     }

                            // echo '</div>';

                            // }

                            ?>

                        </div>

                    </div>

                     <div class="row copyright">
                        <div class="col-xs-12">
                            <p>&copy; <?php echo date('Y'); ?> Eli Vickery</p>
                        </div>
                    </div>

                </div>
            </footer>
        </div><!-- #page -->
		<?php wp_footer(); ?>
	</body>
</html>
