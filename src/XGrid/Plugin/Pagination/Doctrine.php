<?php

  /*
   * 
   */

  /**
   * Description of Doctrine
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Plugin_Pagination_Doctrine extends XGrid_Plugin_Pagination_Abstract {

      private $_datasource;

      public function __construct(XGrid_DataSource_Interface $datasource) {
          $this->_datasource = $datasource;
      }

      public function count() {
           return $this->_datasource->count();
      }

      public function getDecoratableObject() {
          return $this->_datasource->getDecoratableObject();
      }

      public function getIterator() {
          $this->getDecoratableObject()
                  ->limit($this->getItemCountPerPage())
                  ->offset($this->getOffset());
          return $this->_datasource->getIterator();
      }

  }

  