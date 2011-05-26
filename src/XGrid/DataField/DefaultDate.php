<?php
  /**
   * The date date data field implementation. It accepts the PHP date formats.
   * 
   * @see http://php.net/manual/en/function.date.php
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataField_DefaultDate extends XGrid_DataField_Abstract {
   
      private $_format = "d.m.Y i:s";
      
      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

      public function setFormat($_format) {
          $this->_format = $_format;
      }
      
      private function _isTimestamp( $string ) {
          return ( 1 === preg_match( '~^[1-9][0-9]*$~', $string ) );
      }
      
      public function getValue($object) {
          $value = parent::getValue($object);
          if($this->_isTimestamp($value)) {
              return date($this->_format, $value);
          } else {
              return '';
          }
      } 
  }
