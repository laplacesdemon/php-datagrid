<?php

  /*
   * 
   */

  /**
   * Description of Doctrine
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Plugin_Pagination_Doctrine extends XGrid_Plugin_Pagination_Abstract {

      protected $_datasource;

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

  