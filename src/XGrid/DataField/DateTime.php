<?php
  /**
   * The datetime data field implementation. By default, it uses the format of
   * the MySQL's DATETIME type.
   *
   * @see http://dev.mysql.com/doc/refman/5.0/en/datetime.html
   * @author Onur Yaman <onuryaman@gmail.com>
   */
  class XGrid_DataField_DateTime extends XGrid_DataField_Abstract {

      private $_format = "d.m.Y H:i:s";

      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

      public function setFormat($_format) {
          $this->_format = $_format;
      }

      private function _isDateTime($string) {
          return ( 1 === preg_match( '~^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$~', $string ) );
      }

      public function getValue($object) {
          $value = parent::getValue($object);
          if($this->_isDateTime($value)) {
              return date($this->_format, strtotime($value));
          } else {
              return '';
          }
      }
  }
