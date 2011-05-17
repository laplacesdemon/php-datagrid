<?php

  /*
   * 
   */

  /**
   * Description of Date
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Datafield_Date extends XGrid_DataField_Abstract {
   
      private $_format = "dd/MM/yyyy hh:mm";
      
      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

      public function setFormat($_format) {
          $this->_format = $_format;
      }
      
      public function getValue($object) {
          $value = parent::getValue($object);
          try {
              $date = new Zend_Date($value);
              return $date->get($this->_format);
          } catch (Exception $e) {
              return '';
          }
      }
  
  }
