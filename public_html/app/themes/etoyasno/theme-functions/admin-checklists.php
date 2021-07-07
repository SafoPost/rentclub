<?php
function my_admin_menu()
{
    //add_menu_page('Список Emailов','Список Emailов','manage_options','std-regd','registration_callback','dashicons-welcome-write-blog',98);

     add_menu_page('Список денежных операций','Список  денежных операций','manage_options','std-regd','registration_callback','dashicons-welcome-write-blog',98);
}
add_action('admin_menu','my_admin_menu');


function registration_callback()
{
    require_once(get_template_directory().'/admin-page/cash_operation-list.php');
    $registration = new Event_Reg_Table;
    echo '<div class="wrap"><h1 class="wp-heading-inline">Список денежных  операций</h1>';
    echo '<form method="post">';
    $registration->prepare_items();
    $registration->search_box('Search Records','search_record');
    $registration->display();
    echo '</form></div>';
}