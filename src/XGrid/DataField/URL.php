<?php
  /**
   * The URL data field. It allows to put an anchor html element to the
   * record
   * 
   * @author Onur Yaman <onuryaman@gmail.com>
   */
  class XGrid_Datafield_URL extends XGrid_DataField_Abstract {
   
      private $_attributes;
      
      public function __construct($key = null, $attributes = array()) {
          if(!is_null($key)) $this->setKey ($key);
          $this->_attributes = $attributes;
      }
      
      public function setAttributes($attributes) {
          $this->_attributes = $attributes;
          return $this;
      }

      public function getValue($object) {
          $value = parent::getValue($object);
          
          $atts = '';
          $displayText = $value;
          foreach ($this->_attributes as $key => $val) {
              if ('displayText' == $key) {
                  $displayText = $val;
                  continue;
              }
              $atts .= $key . '="' . $val . '" ';
          }

          if (empty($this->_attributes)) {
               $atts = 'href="' . $value . '"';
          } else if (! in_array('href', array_keys($this->_attributes))) {
              $atts = 'href="' . $value . '" ' . $atts;
          }
          
          return '<a ' . trim($atts) . '>' . $displayText . '</a>';
      }
  
  }
