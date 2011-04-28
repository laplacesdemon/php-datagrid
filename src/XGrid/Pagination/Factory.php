<?php

  /*
   * 
   */

  /**
   * Description of Factory
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Pagination_Factory {

      /**
       * creates the right pagination concreate class for the datasource
       * 
       * @param XGrid_DataSource_Interface $datasource
       * @return XGrid_Pagination_Abstract 
       */
      public static function create(XGrid_DataSource_Interface $datasource) {
          $ins = null;
          switch ($datasource) {
              case $datasource instanceof XGrid_DataSource_Array:
                  $ins = new XGrid_Pagination_Array($datasource);
                  break;
              case $datasource instanceof XGrid_DataSource_Doctrine:
                  $ins = new XGrid_Pagination_Doctrine($datasource);
                  break;
          }
          
          if(is_null($ins)) {
              throw new XGrid_Exception("No pagination decorator found for the datasource");
          }
          
          return $ins;
      }
  
  }


