<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Makes the given string uppercased
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_Uppercase extends XGrid_Filter_Abstract {
      
      /**
       * Makes the given string uppercased
       * 
       * @param string $value
       * @param string $row
       * @return string 
       */
      public function filter($value, $row = null) {
          return strtoupper($this->_filter($value, $row));
      }
  }
