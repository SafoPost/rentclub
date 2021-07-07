<?php
if (!class_exists('WP_List_Table')) {
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Event_Reg_Table extends WP_List_Table
{
    public function __construct()
    {
        parent::__construct(array(
            'singular' => 'Operation',
            'plural' => 'Operation',
            'ajax' => false
        ));
    }
    public static function get_records($per_page = 20, $page_number = 1)
    {
        global $wpdb;
        $sql = "select * from wp_cash_operations";
        // if(isset($_REQUEST['user_id'])) {
        //      $sql.= ' where user_id  "' . $_REQUEST['user_id'] . '"';
        // }
        if (isset($_REQUEST['s'])) {
            $sql.= ' where name_operation LIKE "%' . $_REQUEST['s'] . '%"';
        }
        if (!empty($_REQUEST['orderby'])) {
            $sql.= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql.= !empty($_REQUEST['orderby']) ? " " . esc_sql($_REQUEST['orderby']) : "FIELD (status_operation,'in_work')";
           // $sql.= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : 'DESC';
        }else{
            $sql.=" ORDER BY FIELD(status_operation,'in_work') DESC , date DESC";
        }
        $sql.= " LIMIT $per_page";
        $sql.= ' OFFSET ' . ($page_number - 1) * $per_page;
        $wpdb->show_errors( true );
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        return $result;
    }
    function get_columns()
    {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'name_operation' => __('Название операции') ,
            'date' => __('Дата операции'),
            'type_operation' =>__('Тип операции',),
            'user_id' => __('Пользователь') ,
            'deal_id' => __('Сделка'),
            'summa_operation' => __('Сумма операции'),
            'status_operation' => __('Статус')


        ];
        return $columns;
    }

    public function column_default( $item, $column_name )
    {
        switch ( $column_name ) {
            case 'name_operation':
                return $item[ $column_name ];
            case 'type_operation':
                return $item[ $column_name ];
            case 'date':
                return $item[ $column_name ];
            case 'user_id':
                return $item[ $column_name ];
            case 'deal_id':
                return $item[ $column_name ];
            case 'summa_operation':
                return $item[ $column_name ];
            case 'status_operation':
                return $item[ $column_name ];
          



            default:
                return print_r( $item, true );
        }
    }
    function column_cb($item)
    {
        return sprintf('<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']);
    }
    function column_name_operation( $item )
    {
        $actions = array(
            'delete'    => sprintf('<a href="?page=%s&action=%s&record=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
             'edit'      => sprintf('<a href="?page=%s&action=%s&record=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
        );
        return sprintf('%1$s %2$s', $item['name_operation'], $this->row_actions($actions) );
    }
    public function get_bulk_actions()
    {
        $actions = ['bulk-delete' => 'Удалить'];
             $actions = ['bulk-edit' => 'Изменить'];
        return $actions;
    }
    public static function delete_records($id)
    {
        global $wpdb;
        $wpdb->delete("wp_cash_operations", ['id' => $id], ['%d']);

    }
      public static function edit_records($id)
    {
        global $wpdb;
        $wpdb->edit("wp_cash_operations", ['id' => $id], ['%d']);
    }


    public static function record_count()
    {
        global $wpdb;
        $sql = "SELECT COUNT(*) FROM wp_cash_operations";
        return $wpdb->get_var($sql);
    }
    public function no_items()
    {
        _e('No record found in the database.', 'wth');
    }
    public function process_bulk_action()
    {
        if ( 'delete' === $this->current_action() ) {
            self::delete_records( absint( $_GET['record'] ) );
        }
         if ( 'edit' === $this->current_action() ) {
            self::edite_records( absint( $_GET['record'] ) );
        }

        if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-edit' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-edit' )) {
            $edite_ids = esc_sql( $_POST['bulk-edit'] );
            foreach ( $edit_ids as $id ) {
                self::edit_records( $id );
            }
        }
    }
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $sortable );
        $this->process_bulk_action();
        $per_page = $this->get_items_per_page('records_per_page', 12);
        $current_page = $this->get_pagenum();
        $total_items = self::record_count();
        $data = self::get_records($per_page, $current_page);
        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page' => $per_page,
        ]);
        $this->items = $data;
    }
}
