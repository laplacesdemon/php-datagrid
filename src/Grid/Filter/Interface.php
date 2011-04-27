<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface OS_Grid_Filter_Interface {
      
      /**
       * filters the value and returns filtered value
       */
      public function filter($value);
      
  }
