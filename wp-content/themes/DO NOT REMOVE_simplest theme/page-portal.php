<?php
/**
* Template Name: Portal
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <title><?php bloginfo( 'name' ); ?><?php wp_title( '&mdash;' ); ?></title>
        <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="container">
            <div id="header">
                <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <p id="description"><?php bloginfo( 'description' ); ?></p>
                <?php if ( has_nav_menu( 'menu' ) ) : wp_nav_menu(); else : ?>
                <ul><?php wp_list_pages( 'title_li=&depth=-1' ); ?></ul>
                <?php endif; ?>
            </div>

            <div id="content">
                <?php 
                $user = wp_get_current_user();
                $user_id = $user->ID;

                // if ( in_array( 'editor', (array) $user->roles ) ) {}
                
                if (is_user_logged_in()) :
                    $pest_management_data = get_user_meta($user_id, 'pest_management_log_db');
                    ?>

                    <div class="section section-pest-management">
                        <div class="section__inner page-cover"><!-- border: 1px solid #000; padding: 20px; -->
                            <div class="container">
                                <div class="page__top">
                                    <h3><a href="mailto:Admin@wapestconsultants.com.au">Admin@wapestconsultants.com.au</a></h3>
                                    <h3>Ph: <a href="tel:0499 904 014">0499 904 014</a></h3>
                                </div>

                                <div class="page__main">
                                    <div class="image_wrapper">
                                        <img src="http://featuredev.local/wp-content/uploads/2024/05/primary_logo.png" alt="logo">
                                    </div>
                                    <div class="page__main-heading">
                                        <h1>Pest Management Log</h1>
                                        <p>September 2023</p>

                                        <div class="text--special">Clarkson Pizza (Clarkson)</div>
                                    </div>
                                </div>

                                <div class="page__bottom">
                                    <div class="text--special">Quality</div>
                                    <div class="text--special">Integrity</div>
                                    <div class="text--special">Service</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section section-pest-management">
                        <div class="section__inner page-cover"><!-- border: 1px solid #000; padding: 20px; -->
                            <div class="container">
                                <div class="page__top">
                                    <h3><a href="mailto:Admin@wapestconsultants.com.au">Admin@wapestconsultants.com.au</a></h3>
                                    <h3>Ph: <a href="tel:0499 904 014">0499 904 014</a></h3>
                                </div>

                                <div class="page__main">
                                    <div class="image_wrapper">
                                        <img src="http://featuredev.local/wp-content/uploads/2024/05/primary_logo.png" alt="logo">
                                    </div>
                                    <div class="page__main-heading">
                                        <h1>Pest Management Log</h1>
                                        <p>September 2023</p>

                                        <div class="text--special">Clarkson Pizza (Clarkson)</div>
                                    </div>
                                </div>

                                <div class="page__bottom">
                                    <div class="text--special">Quality</div>
                                    <div class="text--special">Integrity</div>
                                    <div class="text--special">Service</div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- <?php
echo '<pre>';
var_dump($pest_management_data);
echo '</pre>';
?> -->
                <?php endif; ?>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>