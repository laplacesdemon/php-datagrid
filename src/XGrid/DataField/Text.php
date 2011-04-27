<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Text
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_DataField_Text extends XGrid_DataField_Abstract {
         
      public function __construct($key = null) {
          if(!is_null($key)) $this->_key = $key;
      }


      public function render() {
          
      }
  }
