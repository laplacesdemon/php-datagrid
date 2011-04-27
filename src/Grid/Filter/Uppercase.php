<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of Uppercase
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class OS_Grid_Filter_Uppercase implements OS_Grid_Filter_Interface {
      
      public function filter($value) {
          return strtoupper($value);
      }
  }
