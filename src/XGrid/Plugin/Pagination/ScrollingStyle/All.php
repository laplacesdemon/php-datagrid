<?php

  /*
   * 
   */

  /**
   * Description of All
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Plugin_Pagination_ScrollingStyle_All implements XGrid_Plugin_Pagination_ScrollingStyle_Interface {
      
      /**
       * returns all ages
       * @param XGrid_Plugin_Pagination_Abstract $pagination
       * @return array 
       */
      public function getPages(XGrid_Plugin_Pagination_Abstract $pagination) {
          return $pagination->getPagesInRange(1, $pagination->count());
      }
  }
