<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */
  
  /**
   * Internal helper class for the object data source.
   */
  class XGrid_DataSource_ObjectIterator implements  Iterator, Countable {
   
      /**
       * internal data
       * @var array
       */
      private $_data = array();
      
      /**
       * internal pointer
       * @var integer
       */
      private $_pointer = 0;

      public function __construct($data) {
          $this->_data = $data;
      }
      
      public function current() {
          return ($this->valid()) ? $this->_data[$this->_pointer] : false;
      }

      public function key() {
          return $this->_pointer;
      }

      public function next() {
          $this->_pointer++;
      }

      public function rewind() {
          $this->_data[0];
      }

      public function valid() {
          return isset($this->_data[$this->_pointer]);
      }

      public function count() {
          return sizeof($this->_data);
      }
      
  }
  
  /**
   * the object data source accepts an array of objects. The object can be a 
   * stdClass member or a custom class
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataSource_Object implements XGrid_DataSource_Interface {
      
      /**
       * internal data
       * @var array
       */
      private $_data = array();

      public function __construct($data) {
          $this->_data = $data;
      }

      /**
       * total number of items (regardless of the current page items)
       * @return type 
       */
      public function count() {
          return sizeof($this->_data);
      }

      public function getIterator() {
          return new XGrid_DataSource_ObjectIterator($this->_data);
      }

      /**
       * Returns the raw data object to decorated by an external class (i.e. plugins)
       * For example the paginator decorator gets the decoratable object and change
       * it to support pagination
       * 
       * @return array
       */
      public function getDecoratableObject() {
          return $this->_data;
      }
  }
