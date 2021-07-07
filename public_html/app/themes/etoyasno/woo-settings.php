<?php

add_filter('woocommerce_product_data_tabs','change_tabs');
function change_tabs($tabs){

    $tabs['attribute']['label'] = 'Атрибуты фильтров';
    $tabs['product_attribute'] = array(
        'label' => 'Атрибуты товара',
        'target' => 'product_attribute_data',
    );
    return $tabs;
};
//создание полей
add_action( 'woocommerce_product_data_panels', 'product_attribute_data' );

function product_attribute_data() {
    global $post;
    $category = wp_get_post_terms($post->ID,'product_cat',array('fields'=>'ids'));
    $attributes = get_field('attributes', 'product_cat_' . $category[0]);
    echo '<div id="product_attribute_data" class="panel woocommerce_options_panel">';
    foreach ($attributes as $attribute){
        switch ($attribute['type'][0]['acf_fc_layout']){
            case 'select':

                $options = [];
                foreach ( $attribute['type'][0]['variants'] as $variant ) {
                    $options[$variant['variant']] = $variant['variant'];
                }
                woocommerce_wp_select( array(
                    'id'      => '_product-att_' . $attribute['id'],
                    'class'             => 'select short wc-enhanced-select',
                    'label'   => $attribute['name'],
                    'options' => $options
                ) );

                break;
            case 'colors':
                $options = [];
                foreach ( $attribute['type'][0]['variants'] as $variant ) {
                    $options[$variant['color_name']] = $variant['color_name'];
                }
                woocommerce_wp_select( array(
                    'id'      => '_product-att_' . $attribute['id'],
                    'label'   => $attribute['name'],
                    'options' => $options
                ) );
                break;
            case 'text':
                if ($attribute['type'][0]['format'] === 'numbers_with_breaks'){
                    woocommerce_wp_text_input(
                        array(
                            'id' => '_product-att_' . $attribute['id'],
                            'placeholder' => $attribute['name'],
                            'label' => $attribute['name'],
                            'type' => 'number',
                            'custom_attributes' => array(
                                'step' => 'any',
                                'min' => $attribute['type'][0]['from_to']['from'],
                                'max' => $attribute['type'][0]['from_to']['to']
                            )
                        )
                    );
                } elseif ($attribute['type'][0]['format'] === 'numbers'){
                    woocommerce_wp_text_input(
                        array(
                            'id' => '_product-att_' . $attribute['id'],
                            'placeholder' => $attribute['name'],
                            'label' => $attribute['name'],
                            'type' => 'number',
                        )
                    );
                } else {
                    woocommerce_wp_text_input(
                        array(
                            'id' => '_product-att_' . $attribute['id'],
                            'placeholder' => $attribute['name'],
                            'label' => $attribute['name'],
                        )
                    );
                }

                break;
            case 'checkbox':
                woocommerce_wp_checkbox( array(
                    'id'      => '_product-att_' . $attribute['id'],
                    'label'   => $attribute['name'],
                    'cbvalue' => 'Да',
                    'description' => $attribute['type'][0]['description']
                ) );
                break;
        }
    }
    echo '</div>';
}

//сохранение полей

add_action( 'woocommerce_admin_process_product_object', 'save_admin_product_custom_fields_values' );
function save_admin_product_custom_fields_values( $product ) {
    $result = array();
    foreach($_POST AS $k=>$v) {
        if(preg_match("/^_product-att_(.*)$/", $k, $matches)) {
            if ( isset($v) ) {
                $product->update_meta_data($k, $v);
            }
        }
    }
}

// This will suppress empty email errors when submitting the user form
add_action('user_profile_update_errors', 'my_user_profile_update_errors', 10, 3 );
function my_user_profile_update_errors($errors, $update, $user) {
    $errors->remove('empty_email');
}

// This will remove javascript required validation for email input
// It will also remove the '(required)' text in the label
// Works for new user, user profile and edit user forms
add_action('user_new_form', 'my_user_new_form', 10, 1);
add_action('show_user_profile', 'my_user_new_form', 10, 1);
add_action('edit_user_profile', 'my_user_new_form', 10, 1);
function my_user_new_form($form_type) {
    ?>
    <script type="text/javascript">
        jQuery('#email').closest('tr').removeClass('form-required').find('.description').remove();
        // Uncheck send new user email option by default
        <?php if (isset($form_type) && $form_type === 'add-new-user') : ?>
        jQuery('#send_user_notification').removeAttr('checked');
        <?php endif; ?>
    </script>
    <?php
}

add_filter( 'woocommerce_account_menu_items', 'QuadLayers_rename_acc_adress_tab', 9999 );
function QuadLayers_rename_acc_adress_tab( $items ) {

    unset($items['edit-address']);
    unset($items['edit-account']);
    unset($items['bookings']);

    $items['dashboard'] = __( 'Мой профиль', 'woocommerce' );
    $items['orders'] = __( 'Мои заказы', 'woocommerce' );
    $items['ads'] = __( 'Мои объявления', 'woocommerce' );
   // $items['cashout'] = __( 'Вывод средств', 'woocommerce' );

    return $items;
}
//добавление страницы мои заказы

function ads_endpoints() {
    add_rewrite_endpoint( 'ads', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'cashout', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'ads_endpoints' );

/**
 * Add new query var.
 *
 * @param array $vars
 * @return array
 */
function ads_query_vars( $vars ) {
 //  var_dump($vars);
    $vars[] = 'ads';
    $vars[] = 'cashout';

    return $vars;
}

add_filter( 'query_vars', 'ads_query_vars', 0 );

function ads_endpoint_content($value) {

   
    $ads_link = explode("/", $value);
    $terms = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'fields'        => 'id=>slug'
    ]);
    if (count($ads_link) > 1){
        $current_term = get_term_by('slug', $ads_link[1], 'product_cat');
        if (in_array($ads_link[1],$terms) && count(get_term_children( $current_term->term_id, 'product_cat' )) === 0) {
            wc_get_template(
                'myaccount/ads/new-ad.php'
            );
        } else {
            wc_get_template(
                'myaccount/ads/category-select.php'
            );
        }
    } else if ( $ads_link[0] === 'add' ) {
        wc_get_template(
            'myaccount/ads/category-select.php'
        );
    } else {
        wc_get_template(
            'myaccount/ads/ads-list.php'
        );
    }
}

add_action( 'woocommerce_account_ads_endpoint', 'ads_endpoint_content' );

function cashout_endpoint_content($value) {

   
 wc_get_template(
    'myaccount/cashout/cashout.php',
    array(
        'target_user' => wp_get_current_user(),
        'show_private' => true,
    )
   );
   
}

add_action( 'woocommerce_account_cashout_endpoint', 'cashout_endpoint_content' );

add_filter("woocommerce_get_query_vars", function ($vars) {
    foreach (["ads"] as $e) {
        $vars[$e] = $e;
    }

     foreach (["cashout"] as $e) {
        $vars[$e] = $e;
    }

    return $vars;

});

//хлебные крошки
add_filter( 'woocommerce_endpoint_ads_title', 'change_my_account_ads_title', 10, 2 );
function change_my_account_ads_title( $title, $endpoint ) {


    $value = get_query_var( $endpoint );
    if ( $value === 'add' ) {
        $title = __( "Новое объявление", "woocommerce" );
    } else {
        $title = __( "Мои объявления", "woocommerce" );
    }
    return $title;
}

add_filter('wpseo_breadcrumb_links', 'woocommerce_account_breadcrumb_trail');
function woocommerce_account_breadcrumb_trail($links) {
    if ( is_wc_endpoint_url() or is_account_page() ) {

        $endpoint       = WC()->query->get_current_endpoint();
        $endpoint_title = WC()->query->get_endpoint_title( $endpoint );
        $endpoint_url   = wc_get_endpoint_url($endpoint);

        if ( is_account_page() && !is_wc_endpoint_url() ) :
            //$links[2] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);



        elseif ( is_wc_endpoint_url( 'cashout' ) ) :

            $links[2] = array('text' => 'Вывод средств', 'url' => $endpoint_url, 'allow_html' => 1);

        elseif ( is_wc_endpoint_url( 'ads' ) ) :
            unset($links[1]);
            $links[2] = array('text' => 'Мои объявления', 'url' => $endpoint_url, 'allow_html' => 1);
            if (get_query_var($endpoint) === 'add'):
                $links[3] = array('text' => 'Создание нового объявления', 'url' => $endpoint_url, 'allow_html' => 1);
            endif;

        elseif ( is_wc_endpoint_url( 'orders' ) ) :
            $links[2] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);

        elseif ( is_wc_endpoint_url( 'view-order' ) ) :
            $endpoint_orders        = 'orders';
            $endpoint_orders_title  = WC()->query->get_endpoint_title( $endpoint_orders );
            $endpoint_orders_url    = wc_get_endpoint_url($endpoint_orders);

            $links[2] = array('text' => $endpoint_orders_title, 'url' => $endpoint_orders_url, 'allow_html' => 1);
            $links[3] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);

        elseif ( is_wc_endpoint_url( 'edit-address' ) ) :
            $links[2] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);

        elseif ( is_wc_endpoint_url( 'payment-methods' ) ) :
            $links[2] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);

        elseif ( is_wc_endpoint_url( 'add-payment-method' ) ) :
            $endpoint_payment_methods       = 'payment-methods';
            $endpoint_payment_methods_title = WC()->query->get_endpoint_title( $endpoint_payment_methods );
            $endpoint_payment_methods_url   = wc_get_endpoint_url($endpoint_payment_methods);

            $links[2] = array('text' => $endpoint_payment_methods_title, 'url' => $endpoint_payment_methods_url, 'allow_html' => 1);
            $links[3] = array('text' => $endpoint_title, 'url' => $endpoint_url, 'allow_html' => 1);

         endif;


    }

    return $links;

}