<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Array
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataSource_Array implements XGrid_DataSource_Interface {

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
          return new XGrid_DataSource_ArrayIterator($this->_data);
      }

      public function getDecoratableObject() {
          return $this->_data;
      }

  }

  