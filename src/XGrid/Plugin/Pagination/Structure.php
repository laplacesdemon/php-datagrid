<?php

  /*
   * 
   */

  /**
   * Description of ScrollingStyle
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Plugin_Pagination_Structure {
      
      private $_pageCount;
      
      private $_itemCountPerPage;
      
      private $_first;
      
      private $_current;
      
      private $_last;
      
      private $_previous;
      
      private $_next;
      
      /**
       *
       * @var array
       */
      private $_pagesInRange;
      
      private $_firstPageInRange;
      
      private $_lastPageInRange;
      
      public function getPageCount() {
          return $this->_pageCount;
      }

      public function setPageCount($_pageCount) {
          $this->_pageCount = $_pageCount;
      }

      public function getItemCountPerPage() {
          return $this->_itemCountPerPage;
      }

      public function setItemCountPerPage($_itemCountPerPage) {
          $this->_itemCountPerPage = $_itemCountPerPage;
      }

      public function getFirst() {
          return $this->_first;
      }

      public function setFirst($_first) {
          $this->_first = $_first;
      }

      public function getCurrent() {
          return $this->_current;
      }

      public function setCurrent($_current) {
          $this->_current = $_current;
      }

      public function getLast() {
          return $this->_last;
      }

      public function setLast($_last) {
          $this->_last = $_last;
      }

      public function getPrevious() {
          return $this->_previous;
      }

      public function setPrevious($_previous) {
          $this->_previous = $_previous;
      }

      public function getNext() {
          return $this->_next;
      }

      public function setNext($_next) {
          $this->_next = $_next;
      }

      /**
       * pages collection
       * @return array
       */
      public function getPagesInRange() {
          return $this->_pagesInRange;
      }

      public function setPagesInRange($_pagesInRange) {
          $this->_pagesInRange = $_pagesInRange;
      }

      public function getFirstPageInRange() {
          return $this->_firstPageInRange;
      }

      public function setFirstPageInRange($_firstPageInRange) {
          $this->_firstPageInRange = $_firstPageInRange;
      }

      public function getLastPageInRange() {
          return $this->_lastPageInRange;
      }

      public function setLastPageInRange($_lastPageInRange) {
          $this->_lastPageInRange = $_lastPageInRange;
      }

        
  }
