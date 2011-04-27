<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface OS_Grid_HtmlHelper_Interface {

      public function createTable();
      
      public function closeTable();
      
      public function createHead();
      
      public function closeHead();
      
      public function createHeadRow();
      
      public function closeHeadRow();
      
      public function createHeadField();
      
      public function closeHeadField();
      
      public function createBody();
      
      public function closeBody();
      
      public function createBodyRow();
      
      public function closeBodyRow();
      
      public function createBodyField();
      
      public function closeBodyField();
      
      public function createFooter();
      
      public function closeFooter();
      
      public function createFooterRow();
      
      public function closeFooterRow();
      
      public function createFooterField();
      
      public function closeFooterField();
  }
