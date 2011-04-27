<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of Text
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class OS_Grid_DataField_Text extends OS_Grid_DataField_Abstract {
         
      public function __construct($key = null) {
          if(!is_null($key)) $this->_key = $key;
      }


      public function render() {
          
      }
  }
