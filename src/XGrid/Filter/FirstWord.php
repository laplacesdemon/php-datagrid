<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * FirstWord filter returns the first word in the given data
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_FirstWord extends XGrid_Filter_Abstract {
      
      /**
       * returns the first word in the given daata
       * 
       * @param string $value
       * @param stdClass $row
       * @return string 
       */
      public function filter($value, $row = null) {
          $arr = explode(' ', $value);
          return $this->_filter($arr[0], $row);
      }
  }

