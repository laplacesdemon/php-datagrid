<?php

  /*
   * 
   */

  /**
   *
   * @author suleyman [at] melikoglu.info
   */
  interface XGrid_Plugin_Pagination_ScrollingStyle_Interface {
      
      /**
       * returns the page collection as array
       * @return array
       */
      public function getPages(XGrid_Plugin_Pagination_Abstract $pagination);
      
  }
