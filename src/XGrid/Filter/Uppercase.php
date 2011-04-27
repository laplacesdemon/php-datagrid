<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Uppercase
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Filter_Uppercase implements XGrid_Filter_Interface {
      
      public function filter($value) {
          return strtoupper($value);
      }
  }
