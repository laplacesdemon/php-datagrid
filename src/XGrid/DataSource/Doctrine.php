<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Data source for the Doctrine ORM framework
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataSource_Doctrine implements XGrid_DataSource_Interface {

      private $_query;
      private $_rowCount = null;

      public function __construct(Doctrine_Query $query) {
          $this->_query = $query;
      }

      private function setRowCount() {
          if (is_integer($this->_rowCount)) {
              return $this;
          } elseif ($this->_query instanceof Doctrine_Query) {
              $this->_rowCount = $this->_query->count();
          } else {
              throw new XGrid_Exception('Invalid doctrine query', 500);
          }

          return $this;
      }

      public function count() {
          if (is_null($this->_rowCount)) {
              $this->setRowCount();
          }
          return $this->_rowCount;
      }

      public function getDecoratableObject() {
          return $this->_query;
      }

      public function getIterator() {
          $collection = $this->_query->execute();
          return $collection->getIterator();
      }

  }
