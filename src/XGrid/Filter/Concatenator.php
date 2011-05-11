<?php

  /*
   * 
   */

  /**
   * Description of Appender
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Filter_Concatenator extends XGrid_Filter_Abstract {
     
      private $_textToPrepend = "";
      private $_textToAppend = "";
      


      public function __construct($textToPrepend = "", $textToAppend = "") {
          $this->_textToPrepend = $textToPrepend;
          $this->_textToAppend = $textToAppend;
      }
      
      public function filter($value, $row = null) {      
          return parent::_filter(
                  $this->_textToPrepend . $value . $this->_textToAppend, 
                  $row);
      }
  }
