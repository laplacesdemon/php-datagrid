<?php

  /*
   * 
   */

  /**
   * Description of FirstWord
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Filter_FirstWord extends XGrid_Filter_Abstract {
      
      public function filter($value, $row = null) {
          $arr = explode(' ', $value);
          return $this->_filter($arr[0], $row);
      }
  }

