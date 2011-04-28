<?php

  /*
   * 
   */

  /**
   * Description of Pagination
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Plugin_DefaultPaginator extends XGrid_Plugin_Abstract {
      
      /**
       * internal paginator
       * @var XGrid_Plugin_Pagination_Abstract
       */
      private $_paginator;
      
      /**
       * 
       * @var integer
       */
      protected $_itemCountPerPage;
      
      /**
       * current page number
       * @var integer
       */
      protected $_currentPage;
      
      /**
       *
       * @var type 
       */
      protected $_range;
      
      /**
       * paginator strategy type 
       * use constants in XGrid_Plugin_Pagination class
       * @var type 
       */
      protected $_type;
  
      public function getItemCountPerPage() {
          return $this->_itemCountPerPage;
      }

      public function setItemCountPerPage($_itemCountPerPage) {
          $this->_itemCountPerPage = $_itemCountPerPage;
      }

      public function getCurrentPage() {
          return $this->_currentPage;
      }

      public function setCurrentPage($_currentPage) {
          $this->_currentPage = $_currentPage;
      }
      
      public function getRange() {
          return $this->_range;
      }

      public function setRange($_range) {
          $this->_range = $_range;
      }

      public function getType() {
          return $this->_type;
      }

      public function setType($_type) {
          $this->_type = $_type;
      }

            
      public function init() {
          // nothing to init
      }
      
      public function postDispatch() {
          // nothing to add
      }
      
      public function preDispatch() {
          $this->_paginator = XGrid_Plugin_Pagination_Factory::create($this->getXgrid()->getDataSource());
          $this->_paginator->setCurrentPage($this->getCurrentPage());
          $this->_paginator->setItemCountPerPage($this->getItemCountPerPage());
          // override the datasource
          $this->getXgrid()->setDataSource($this->_paginator);
      }

      
  }

