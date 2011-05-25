<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Uppercase
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_Uppercase extends XGrid_Filter_Abstract {
      
      public function filter($value, $row = null) {
          return strtoupper($this->_filter($value, $row));
      }
  }
