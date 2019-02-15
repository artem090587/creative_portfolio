            <?php if ( get_theme_mod( 'enable_footer_widgets', '1' ) ) : ?>
            <footer class="footer-site">
                <div class="container">
                    <div class="row">

                        <?php
                            $footer_columns = get_theme_mod( 'footer_columns', '4' );
                        ?>

                        <?php if ( $footer_columns == '2' ) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer1'); ?>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer2'); ?>
                            </div>
                        <?php } elseif ( $footer_columns == '3' ) { ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer1'); ?>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer2'); ?>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <?php dynamic_sidebar('footer3'); ?>
                            </div>
                        <?php } elseif ( $footer_columns == '4' ) { ?>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer1'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer2'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer3'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer4'); ?>
                            </div>
                        <?php } elseif ( $footer_columns == 'left-large' ) { ?>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer1'); ?>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer2'); ?>
                            </div>
                        <?php } elseif ( $footer_columns == 'right-large' ) { ?>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer1'); ?>
                            </div>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer2'); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </footer>
            <?php endif; ?>
            
            <footer class="footer-bottom">
                <div class="container text-center">

                    <?php if ( get_theme_mod( 'enable_footer_social_media', '1' ) ) : ?>
                        <div class="footer-social">
                            <?php $social_networks = get_theme_mod( 'social_networks', array() ); ?>
                            <?php if ( ! empty( $social_networks ) ) : ?>
                                <ul class="footer-social-list">
                                    <?php foreach ( $social_networks as $social_network ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url_raw( $social_network['url'] ); ?>" target="_blank">
                                                <i class="fa fa-<?php echo esc_attr( $social_network['network'] ); ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="copyright-text">
                        <span>
                            <?php
                            $footer_copyright = get_theme_mod( 'copyright_text', esc_html__( '&copy; 2018. Onliest Creative One-Page WordPress Theme', 'onliestwp' ) );
                            echo htmlspecialchars_decode( wp_kses_post( $footer_copyright ) );
                            ?>
                        </span>
                    </div>

                </div>
            </footer>

            <?php if ( get_theme_mod( 'enable_go_top', '1' ) ) : ?>
            <a href="#" class="go-top-button">
                <i class="fa fa-angle-up"></i>
            </a>
            <?php endif; ?>
        </div> <!-- end /#wrapper -->

        <?php do_action( 'onliest_after_footer' ); ?>

        <?php wp_footer(); ?>

	</body>

</html>