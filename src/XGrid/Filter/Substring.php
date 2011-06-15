<?php

  /**
   * Filters the datafield by the given sub string parameters.
   * This is a wrapper class around the PHP function substr
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_Substring extends XGrid_Filter_Abstract {
      
      private $_start = 0;
      
      private $_length = null;
      
      public function __construct($start, $length = null) {
          $this->_start = $start;
          $this->_length = $length;
      }
      
      public function filter($value, $row = null) {
          return substr($value, $this->_start, $this->_length);
      }
  
  }
