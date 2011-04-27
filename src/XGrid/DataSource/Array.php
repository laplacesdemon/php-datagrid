<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of Array
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_DataSource_Array implements XGrid_DataSource_Interface {
   
      /**
       * internal data
       * @var array
       */
      private $_data = array();
     
      /**
       * internal pointer
       * @var integer
       */
      private $_i = 0;
      
      public function __construct($data) {
          $this->_data = $data;
      }
      
      public function count() {
          return sizeof($this->_data);
      }

      public function current() {
          if(!$this->valid()) 
              return null;
          
          if(is_array($this->_data[$this->_i]))
              return (object) $this->_data[$this->_i];
          
          return $this->_data[$this->_i];
      }

      public function key() {
          return $this->_i;
      }

      public function next() {
          $this->_i++;
      }

      public function rewind() {
          $this->_i = 0;
      }

      public function valid() {
          return isset($this->_data[$this->_i]);
      }
      
  }
