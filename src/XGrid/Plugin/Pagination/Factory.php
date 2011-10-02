<?php

  /*
   * 
   */

  /**
   * Description of Factory
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Plugin_Pagination_Factory {

      /**
       * creates the right pagination concreate class for the datasource
       * 
       * @param XGrid_DataSource_Interface $datasource
       * @return XGrid_Plugin_Pagination_Abstract 
       */
      public static function create(XGrid_DataSource_Interface $datasource) {
          if($datasource instanceof XGrid_Plugin_Pagination_Abstract) {
              return $datasource;
          }
          
          $ins = null;
          switch ($datasource) {
              case $datasource instanceof XGrid_DataSource_Array:
                  $ins = new XGrid_Plugin_Pagination_Array($datasource);
                  break;
              case $datasource instanceof XGrid_DataSource_Doctrine:
                  $ins = new XGrid_Plugin_Pagination_Doctrine($datasource);
                  break;
              case $datasource instanceof XGrid_DataSource_Doctrine2:
                  $ins = new XGrid_Plugin_Pagination_Doctrine2($datasource);
                  break;
          }
          
          if(is_null($ins)) {
              throw new XGrid_Exception("No pagination decorator found for the datasource");
          }
          
          return $ins;
      }
  
  }


