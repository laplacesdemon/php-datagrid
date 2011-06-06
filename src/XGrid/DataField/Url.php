<?php
  /**
   * The URL data field. It allows to put an anchor html element to the
   * record
   * 
   * @author Onur Yaman <onuryaman@gmail.com>
   */
  class XGrid_DataField_Url extends XGrid_DataField_Abstract {
   
      private $_attributes;
      private $_displayText;
      
      public function __construct($key = null, $attributes = array()) {
          if(!is_null($key)) $this->setKey ($key);
          $this->_attributes = $attributes;
      }
      
      public function setAttributes($attributes) {
          $this->_attributes = $attributes;
          return $this;
      }

      public function setDisplayText($displayText) {
          $this->_displayText = $displayText;
          return $this;
      }

      public function getValue($object) {
          $value = parent::getValue($object);
          
          $atts = '';
          foreach ($this->_attributes as $key => $val) {
              $atts .= $key . '="' . $val . '" ';
          }

          if (empty($this->_attributes)) {
              $atts = 'href="' . $value . '"';
          } else if (! in_array('href', array_keys($this->_attributes))) {
              $atts = 'href="' . $value . '" ' . $atts;
          }

          $displayText = ($this->_displayText) ? $this->_displayText : $value;
          return '<a ' . trim($atts) . '>' . $displayText . '</a>';
      }
  
  }
