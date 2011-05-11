<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface XGrid_Filter_Interface {
      
      /**
       * filters the value and returns filtered value
       */
      public function filter($value, $row = null);
      
  }
