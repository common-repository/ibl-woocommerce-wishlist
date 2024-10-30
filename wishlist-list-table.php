<?php 
if (! defined('ABSPATH')) {
  die();
}
$exampleListTable = new WCCWL_List_Table();
$exampleListTable->prepare_items();
?>
<div class="wrap">
  <div>
    <i class="icon-users" style="float: left;margin-right: 12px;font-size: 24px;"></i>
    <!--  <div id="icon-users" class="icon32"></div> -->
    <h2 style="font-size: 2.3em;">Wishlists</h2>
  </div>

  <?php $exampleListTable->display(); ?>
</div>
<?php


if( ! class_exists( 'WP_List_Table' ) ) {
   // echo "fgsdf";
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Create a new table class that will extend the WP_List_Table
 */
class WCCWL_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
      $columns = $this->get_columns();
      $hidden = $this->get_hidden_columns();
      $sortable = $this->get_sortable_columns();
      $data = $this->table_data();      
      usort( $data, array( &$this, 'sort_data' ) );
      $this->process_bulk_action();
      $perPage = 2;
      $currentPage = $this->get_pagenum();
      $totalItems = count($data);
      $this->set_pagination_args( array(
        'total_items' => $totalItems,
        'per_page'    => $perPage
        ) );
      $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
      $this->_column_headers = array($columns, $hidden, $sortable);
      $this->items = $data;
    }
    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
      $columns = array(

        'wishlistname' => 'Name',
        'username'       => 'Username',
        'description' => 'items in wishlist',

        );
      return $columns;
    }
    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
      return array();
    }
    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
      return array('username' => array('username', false));
    }
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
      $data = array();
      $userid=get_current_user_id();

      global $wpdb;
      $listname="SELECT count(meta_value) as items_in_wishlist,meta_value  FROM {$wpdb->prefix}postmeta WHERE meta_key='listname".$userid."'";

      $list=$wpdb->get_results($listname);

      $username=get_userdata( $userid ); 

      $username=$username->data->user_login;

      foreach ($list as $key => $value) {
       $data[] = array(
        'wishlistname'          => $value->meta_value,
        'username'       => get_avatar($userid,$size=30).$username,
        'description' => $value->items_in_wishlist

        );

     }
     return $data;
   }
    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
      switch( $column_name ) {
        case 'wishlistname':
        case 'username':
        case 'description':

        return $item[ $column_name ];

        default:
        return print_r( $item, true ) ;
      }
    }
    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
      $orderby = 'username';
      $order = 'asc';
        // If orderby is set, use this as the sort column
      if(!empty(sanitize_text_field($_GET['orderby'])))
      {
        $orderby = sanitize_text_field($_GET['orderby']);
      }
        // If order is set use this as the order
      if(!empty(sanitize_text_field($_GET['order'])))
      {
        $order = sanitize_text_field($_GET['order']);
      }
      $result = strcmp( $a[$orderby], $b[$orderby] );
      if($order === 'asc')
      {
        return $result;
      }
      return -$result;
    }

    function column_id($item){
      $actions = array(
        'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',sanitize_text_field($_REQUEST['page']),'delete',$item['wishlistname']),
        );
      return sprintf('%1$s %2$s', $item['wishlistname'], $this->row_actions($actions) );
    }

  }

  ?>
