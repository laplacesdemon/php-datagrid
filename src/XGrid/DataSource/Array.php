<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */
  
  /**
   * The array datasource. Allows to use an associated array as the data source
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

  