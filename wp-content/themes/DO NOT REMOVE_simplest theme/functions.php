<?php
if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'automatic-feed-links' );
if ( function_exists( 'register_nav_menu' ) ) register_nav_menu( 'menu', 'Menu' );
if ( function_exists('register_sidebar') ) register_sidebar( array(
  'name' => __( 'Widgets', 'simplest' ),
  'id' => 'widgets',
  'before_widget' => '<div class="widget">',
  'after_widget' => '</div><!-- widget -->',
  'before_title' => '<h4>',
  'after_title' => '</h4>') );

/**
 * Proper way to enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'simplest_enqueue_files' );
function simplest_enqueue_files() {
    // wp_enqueue_script('jquery-ui-tabs-js', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js', array('jquery'));
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/style.css' );
    // wp_enqueue_script( 'custom-tabs', get_stylesheet_directory_uri() . '/js/tabs.js', array('jquery'), '1.0.0', true);
}

add_action( 'admin_enqueue_scripts', 'simplest_enqueue_admin_scripts' );
function simplest_enqueue_admin_scripts() {
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_style( 'jquery-ui-tabs-style', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css' );
    wp_enqueue_style( 'custom-admin-style', get_template_directory_uri() . '/admin-style.css' );
}


// Add custom field in user profile
add_action( 'show_user_profile', 'cxc_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'cxc_extra_user_profile_fields' );

function cxc_extra_user_profile_fields( $user ) {
    $user_id = get_current_user_id();
    $pest_management_log = get_user_meta($user_id, 'pest_management_log_db', true);
        wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>
    
    <div id="repeater-tabs">
        <ul>
            <li><a href="#repeater-tab-1">PRODUCT TREATMENT</a></li>
            <li><a href="#repeater-tab-2">RODENT STATION LOCATION</a></li>
            <li><a href="#repeater-tab-3">PEST SIGHTING LOG</a></li>
        </ul>

        <div id="repeater-tab-1" class="repeater-tab">
            <table id="pest-managemet-repeater-1" class="repeater__wrapper" width="100%">
                <thead>
                    <tr>
                        <th class="repeater-row-handle" width="30px"></th>
                        <th class="repeater-th">Date</th>
                        <th class="repeater-th">Chem</th>
                        <th class="repeater-th">Conc</th>
                        <th class="repeater-th">OP LIC No</th>
                        <th class="repeater-th">Location Of Treatment</th>
                        <th class="repeater-row-handle" width="20px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ( $pest_management_log['treatment'] ) :
                        foreach ( $pest_management_log['treatment'] as $key => $field ) : ?>
                            <tr class="repeater-row">
                                <td class="repeater-td-handle repeater-td-handle__count"><?php echo ++$key ?></td>
                                <td><input type="date" name="treatment_date[]" value="<?php if($field['treatment_date'] != '') echo esc_attr( $field['treatment_date'] ); ?>" min="2000-01-01" max="2099-12-31"></td>
                                <td><input type="text" name="treatment_chem[]" value="<?php if($field['treatment_chem'] != '') echo esc_attr( $field['treatment_chem'] ); ?>"></td> 
                                <td><input type="text" name="treatment_conc[]" value="<?php if($field['treatment_conc'] != '') echo esc_attr( $field['treatment_conc'] ); ?>"></td> 
                                <td><input type="text" name="treatment_oplicno[]" value="<?php if($field['treatment_oplicno'] != '') echo esc_attr( $field['treatment_oplicno'] ); ?>"></td> 
                                <td><input type="text" name="treatment_location[]" value="<?php if($field['treatment_location'] != '') echo esc_attr( $field['treatment_location'] ); ?>"></td> 
                                <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#1">-</a></td>
                            </tr>
                        <?php
                        endforeach;
                    else : ?>
                        <!-- show a blank one -->
                        <tr class="repeater-row">
                            <td class="repeater-td-handle repeater-td-handle__count">1</td>
                            <td><input type="date" name="treatment_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                            <td><input type="text" name="treatment_chem[]"></td>
                            <td><input type="text" name="treatment_conc[]"></td>
                            <td><input type="text" name="treatment_oplicno[]"></td>
                            <td><input type="text" name="treatment_location[]"></td>
                            <td class="repeater-td-handle"><a class="button button-remove cmb-remove-row-button button-disabled" href="#">-</a></td>
                        </tr>
                    <?php endif; ?>

                    <!-- empty hidden one for jQuery -->
                    <tr class="repeater-row empty-row screen-reader-text">
                        <td class="repeater-td-handle repeater-td-handle__count">1</td>
                        <td><input type="date" name="treatment_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                        <td><input type="text" name="treatment_chem[]"></td>
                        <td><input type="text" name="treatment_conc[]"></td>
                        <td><input type="text" name="treatment_oplicno[]"></td>
                        <td><input type="text" name="treatment_location[]"></td>
                        <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#">-</a></td>
                    </tr>
                </tbody>
            </table>
            <a class="button" href="#" data-event="add-row" data-target="pest-managemet-repeater-1">Add Row</a>
        </div>

        <div id="repeater-tab-2" class="repeater-tab">
            <table id="pest-managemet-repeater-2" class="repeater__wrapper" width="100%">
                <thead>
                    <tr>
                        <th class="repeater-row-handle" width="30px"></th>
                        <th class="repeater-th">Date</th>
                        <th class="repeater-th">Chem</th>
                        <th class="repeater-th">Conc</th>
                        <th class="repeater-th">OP LIC No</th>
                        <th class="repeater-th">Location Of Treatment</th>
                        <th class="repeater-row-handle" width="20px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ( $pest_management_log['location'] ) :
                        foreach ( $pest_management_log['location'] as $key => $field ) : ?>
                            <tr class="repeater-row">
                                <td class="repeater-td-handle repeater-td-handle__count"><?php echo ++$key ?></td>
                                <td><input type="date" name="location_date[]" value="<?php if($field['location_date'] != '') echo esc_attr( $field['location_date'] ); ?>" min="2000-01-01" max="2099-12-31"></td>
                                <td><input type="text" name="location_chem[]" value="<?php if($field['location_chem'] != '') echo esc_attr( $field['location_chem'] ); ?>"></td> 
                                <td><input type="text" name="location_conc[]" value="<?php if($field['location_conc'] != '') echo esc_attr( $field['location_conc'] ); ?>"></td> 
                                <td><input type="text" name="location_oplicno[]" value="<?php if($field['location_oplicno'] != '') echo esc_attr( $field['location_oplicno'] ); ?>"></td> 
                                <td><input type="text" name="location_location[]" value="<?php if($field['location_location'] != '') echo esc_attr( $field['location_location'] ); ?>"></td> 
                                <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#1">-</a></td>
                            </tr>
                        <?php
                        endforeach;
                    else : ?>
                        <!-- show a blank one -->
                        <tr class="repeater-row">
                            <td class="repeater-td-handle repeater-td-handle__count">1</td>
                            <td><input type="date" name="location_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                            <td><input type="text" name="location_chem[]"></td>
                            <td><input type="text" name="location_conc[]"></td>
                            <td><input type="text" name="location_oplicno[]"></td>
                            <td><input type="text" name="location_location[]"></td>
                            <td class="repeater-td-handle"><a class="button button-remove cmb-remove-row-button button-disabled" href="#">-</a></td>
                        </tr>
                    <?php endif; ?>

                    <!-- empty hidden one for jQuery -->
                    <tr class="repeater-row empty-row screen-reader-text">
                        <td class="repeater-td-handle repeater-td-handle__count">1</td>
                        <td><input type="date" name="location_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                        <td><input type="text" name="location_chem[]"></td>
                        <td><input type="text" name="location_conc[]"></td>
                        <td><input type="text" name="location_oplicno[]"></td>
                        <td><input type="text" name="location_location[]"></td>
                        <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#">-</a></td>
                    </tr>
                </tbody>
            </table>
            <a class="button" href="#" data-event="add-row" data-target="pest-managemet-repeater-2">Add Row</a>
        </div>
        
        <div id="repeater-tab-3" class="repeater-tab">
            <table id="pest-managemet-repeater-3" class="repeater__wrapper" width="100%">
                <thead>
                    <tr>
                        <th class="repeater-row-handle" width="30px"></th>
                        <th class="repeater-th">Date</th>
                        <th class="repeater-th">Time</th>
                        <th class="repeater-th">Location of sighting</th>
                        <th class="repeater-th">Type of pest</th>
                        <th class="repeater-th">Employee Initial</th>
                        <th class="repeater-th">Action Taken</th>
                        <th class="repeater-row-handle" width="20px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ( $pest_management_log['sighting'] ) :
                        foreach ( $pest_management_log['sighting'] as $key => $field ) : ?>
                            <tr class="repeater-row">
                                <td class="repeater-td-handle repeater-td-handle__count"><?php echo ++$key ?></td>
                                <td><input type="date" name="sighting_date[]" value="<?php if($field['sighting_date'] != '') echo esc_attr( $field['sighting_date'] ); ?>" min="2000-01-01" max="2099-12-31"></td>
                                <td><input type="text" name="sighting_time[]" value="<?php if($field['sighting_time'] != '') echo esc_attr( $field['sighting_time'] ); ?>"></td> 
                                <td><input type="text" name="sighting_location[]" value="<?php if($field['sighting_location'] != '') echo esc_attr( $field['sighting_location'] ); ?>"></td> 
                                <td><input type="text" name="sighting_type[]" value="<?php if($field['sighting_type'] != '') echo esc_attr( $field['sighting_type'] ); ?>"></td> 
                                <td><input type="text" name="sighting_inital[]" value="<?php if($field['sighting_inital'] != '') echo esc_attr( $field['sighting_inital'] ); ?>"></td> 
                                <td><input type="text" name="sighting_action[]" value="<?php if($field['sighting_action'] != '') echo esc_attr( $field['sighting_action'] ); ?>"></td> 
                                <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#1">-</a></td>
                            </tr>
                        <?php
                        endforeach;
                    else : ?>
                        <!-- show a blank one -->
                        <tr class="repeater-row">
                            <td class="repeater-td-handle repeater-td-handle__count">1</td>
                            <td><input type="date" name="sighting_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                            <td><input type="text" name="sighting_time[]"></td>
                            <td><input type="text" name="sighting_location[]"></td>
                            <td><input type="text" name="sighting_type[]"></td>
                            <td><input type="text" name="sighting_inital[]"></td>
                            <td><input type="text" name="sighting_action[]"></td>
                            <td class="repeater-td-handle"><a class="button button-remove cmb-remove-row-button button-disabled" href="#">-</a></td>
                        </tr>
                    <?php endif; ?>

                    <!-- empty hidden one for jQuery -->
                    <tr class="repeater-row empty-row screen-reader-text">
                        <td class="repeater-td-handle repeater-td-handle__count">1</td>
                        <td><input type="date" name="sighting_date[]" value="" min="2000-01-01" max="2099-12-31"></td>
                        <td><input type="text" name="sighting_time[]"></td>
                        <td><input type="text" name="sighting_location[]"></td>
                        <td><input type="text" name="sighting_type[]"></td>
                        <td><input type="text" name="sighting_inital[]"></td>
                        <td><input type="text" name="sighting_action[]"></td>
                        <td class="repeater-td-handle"><a class="button button-remove remove-row" href="#">-</a></td>
                    </tr>
                </tbody>
            </table>
            <a class="button" href="#" data-event="add-row" data-target="pest-managemet-repeater-2">Add Row</a>
        </div>
    </div>
    
    

    <script type="text/javascript">
        jQuery(document).ready(function( $ ) {
            $( '#repeater-tabs' ).tabs();

            $( '.button[data-event="add-row"]' ).on('click', function() {
                var target = $(this).attr('data-target');
                var curTable = $(this).parent('.repeater-tab').find('#' + target);
                var countItems = curTable.find('.repeater-row:not(.empty-row)').length;
                var row = curTable.find('.empty-row.screen-reader-text').clone(true);
                row.removeClass('empty-row screen-reader-text');
                row.insertBefore('#' + target + ' tbody>tr:last');
                row.find('.repeater-td-handle__count').html(countItems + 1);
                return false;
            });

            $( '.remove-row' ).on('click', function() {
                $(this).parents('tr').remove();
                return false;
            });
        });
    </script>

	<?php
}

add_action( 'personal_options_update', 'cxc_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'cxc_save_extra_user_profile_fields' );
function cxc_save_extra_user_profile_fields( $user_id ) {
	if ( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) )
        return;
	if( ! current_user_can( 'edit_user', $user_id ) ) {
		return;
	}

    $old = get_user_meta($user_id, 'pest_management_log_db', true);
    $new = array(
        'treatment' => array(),
        'location' => array(),
        'sighting' => array(),
    );

    $treatmentItems = $_POST['treatment_date'];
    $locationItems  = $_POST['location_date'];
    $sightingItems  = $_POST['sighting_date'];
    // $treatmentCount = count( $treatmentItems );
    // $locationCount  = count( $locationItems );

    for ( $i = 0; $i < count( $treatmentItems ); $i++ ) {
        if ( $treatmentItems[$i] != '' ) :
            $new['treatment'][$i]['treatment_date']     = stripslashes( strip_tags( $_POST['treatment_date'][$i] ));
            $new['treatment'][$i]['treatment_chem']     = stripslashes( strip_tags( $_POST['treatment_chem'][$i] ));
            $new['treatment'][$i]['treatment_conc']     = stripslashes( strip_tags( $_POST['treatment_conc'][$i] ));
            $new['treatment'][$i]['treatment_oplicno']  = stripslashes( strip_tags( $_POST['treatment_oplicno'][$i] ));
            $new['treatment'][$i]['treatment_location'] = stripslashes( strip_tags( $_POST['treatment_location'][$i] ));
        endif;
    }

    for ( $i = 0; $i < count( $locationItems ); $i++ ) {
        if ( $locationItems[$i] != '' ) :
            $new['location'][$i]['location_date']       = stripslashes( strip_tags( $_POST['location_date'][$i] ));
            $new['location'][$i]['location_chem']       = stripslashes( strip_tags( $_POST['location_chem'][$i] ));
            $new['location'][$i]['location_conc']       = stripslashes( strip_tags( $_POST['location_conc'][$i] ));
            $new['location'][$i]['location_oplicno']    = stripslashes( strip_tags( $_POST['location_oplicno'][$i] ));
            $new['location'][$i]['location_location']   = stripslashes( strip_tags( $_POST['location_location'][$i] ));
        endif;
    }
    
    for ( $i = 0; $i < count( $sightingItems ); $i++ ) {
        if ( $sightingItems[$i] != '' ) :
            $new['sighting'][$i]['sighting_date']       = stripslashes( strip_tags( $_POST['sighting_date'][$i] ));
            $new['sighting'][$i]['sighting_time']       = stripslashes( strip_tags( $_POST['sighting_time'][$i] ));
            $new['sighting'][$i]['sighting_location']   = stripslashes( strip_tags( $_POST['sighting_location'][$i] ));
            $new['sighting'][$i]['sighting_type']       = stripslashes( strip_tags( $_POST['sighting_type'][$i] ));
            $new['sighting'][$i]['sighting_inital']     = stripslashes( strip_tags( $_POST['sighting_inital'][$i] ));
            $new['sighting'][$i]['sighting_action']     = stripslashes( strip_tags( $_POST['sighting_action'][$i] ));
        endif;
    }
    
    if ( !empty( $new ) && $new != $old )
        update_user_meta( $user_id, 'pest_management_log_db', $new );
    elseif ( empty($new) && $old )
        delete_user_meta( $user_id, 'pest_management_log_db', $old );
}
