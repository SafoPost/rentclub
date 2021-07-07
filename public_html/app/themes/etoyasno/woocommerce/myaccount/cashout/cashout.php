<?php 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb;
$user = wp_get_current_user();
$id = $user->ID;



$items_per_page = 12;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset = ( $page * $items_per_page ) - $items_per_page;


$table_name ="wp_cash_operations";

$total_query = "SELECT COUNT(*) FROM wp_cash_operations";

$total = $wpdb->get_var( $total_query );

$results = $wpdb->get_results( "SELECT * FROM  wp_cash_operations WHERE user_id = $id  ORDER BY `date` DESC  LIMIT ". $offset.", ". $items_per_page);



//$results = $wpdb->get_results( "SELECT * FROM  wp_cash_operations WHERE user_id = $id  ORDER BY `date` DESC");




?>

<?php
wc_get_template(
    'myaccount/cashout/cash_out_page.php',
    array(
        'target_user' => wp_get_current_user(),
        'show_private' => true,
        'operations'=> $results,

        'total'=>$total,
        'page'=>$page,
        'items_per_page' =>$items_per_page
    )
);
?>