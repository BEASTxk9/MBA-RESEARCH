<?php

namespace WPDataAccess\Data_Tables;

use  WPDataAccess\Data_Dictionary\WPDA_List_Columns_Cache ;
use  WPDataAccess\WPDA ;
class WPDA_Search_Builder
{
    private  $wpda_list_columns = null ;
    private  $column_labels = array() ;
    public function __construct( $schema_name, $table_name )
    {
        if ( null === $this->wpda_list_columns ) {
            throw \Exception( "This feature is only available in the premium version" );
        }
    }
    
    public function qb()
    {
        return '';
    }
    
    private function qb_group( $data )
    {
    }
    
    private function qb_criteria( $crit )
    {
    }

}