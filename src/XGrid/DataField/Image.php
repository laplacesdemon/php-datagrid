<?php
  /**
   * The image data field implementation. Given the URL of the image that is to
   * be shown, builds up the corresponding image code.
   *
   * @author Onur Yaman <onuryaman@gmail.com>
   */
  class XGrid_DataField_Image extends XGrid_DataField_Abstract {

      private $_format = '<img src="%s" alt="Brand Logo" title="Brand Logo" />';

      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

      public function setFormat($_format) {
          $this->_format = $_format;
      }

      private function _isURL($string) {
          return ( 1 === preg_match( '~^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$~i', $string ) );
      }

      public function getValue($object) {
          $value = parent::getValue($object);
          if($this->_isURL($value)) {
              return sprintf($this->_format, $value);
          } else {
              return '';
          }
      }
  }
