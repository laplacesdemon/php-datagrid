<?php
  /**
   * The URL data field. It allows to put an anchor html element to the
   * record
   * 
   * @author suleyman [at] melikoglu.info
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
          foreach ($this->_attributes as $key => $val) {
              $atts .= $key . '="' . $val . '" ';
          }
          
          return '<a ' . trim($atts) . '>' . $value . '</a>';
      }
  
  }
