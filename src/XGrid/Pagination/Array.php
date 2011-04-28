<?php

  /*
   * 
   */

  /**
   * Pagination decorator. 
   * This class decorates the array datasource to support pagination.
   * It basically manipulates the internal array using the current page and count
   * of items per page
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Pagination_Array extends XGrid_Pagination_Abstract {

      private $_datasource;

      public function __construct(XGrid_DataSource_Interface $datasource) {
          $this->_datasource = $datasource;
      }

      public function count() {
          return $this->_datasource->count();
      }

      public function getIterator() {
          $arr = $this->_datasource->getDecoratableObject();
          return new XGrid_DataSource_ArrayIterator(array_slice($arr, $this->getOffset(), $this->getItemCountPerPage()));
      }

      public function getDecoratableObject() {
          return $this->_datasource->getDecoratableObject();
      }

  }

  