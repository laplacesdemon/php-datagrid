<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Uppercase
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Filter_Uppercase extends XGrid_Filter_Abstract {
      
      public function filter($value, $row = null) {
          return strtoupper($this->_filter($value, $row));
      }
  }
