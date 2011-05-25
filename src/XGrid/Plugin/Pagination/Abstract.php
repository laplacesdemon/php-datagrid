<?php

  /*
   * 
   */

  /**
   * Description of Abstract
   *
   * @author suleyman [at] melikoglu.info
   */
  abstract class XGrid_Plugin_Pagination_Abstract implements XGrid_DataSource_Interface {

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
       * page range for using in the scrolling style
       * @var integer
       */
      protected $_range = 6;
      
      /**
       * total number of pages
       * @var integer
       */
      protected $_pageCount = null;

      /**
       * pages to show in the pagination
       * it stores, last, previous, next and first page numbers
       * as well as the pages collection to show in the pagination html
       * pages are calculated using the registered scrolling style
       * 
       * @var XGrid_Plugin_Pagination_Structure
       */
      protected $_structure;
      
      /**
       * Scrolling style calcultes the pages to show 
       * 
       * @var XGrid_Plugin_Pagination_ScrollingStyle_Interface
       */
      protected $_scrollingStyle = null;


      /**
       * maximum number of items on per page
       * @return integer 
       */
      public function getItemCountPerPage() {
          return $this->_itemCountPerPage;
      }

      public function setItemCountPerPage($_itemCountPerPage) {
          $this->_itemCountPerPage = $_itemCountPerPage;
      }

      /**
       * returns the current page number
       * @return integer
       */
      public function getCurrentPage() {
          return $this->_currentPage;
      }

      public function setCurrentPage($_currentPage) {
          $this->_currentPage = $_currentPage;
      }

      public function getRange() {
          return $this->_range;
      }

      public function setRange($range) {
          $this->_range = $range;
      }

      public function getScrollingStyle() {
          return $this->_scrollingStyle;
      }

      public function setScrollingStyle($_scrollingStyle) {
          $this->_scrollingStyle = $_scrollingStyle;
      }
      
      /**
       * pages to show in the pagination<br />
       * it stores, last, previous, next and first page numbers<br />
       * as well as the pages collection to show in the pagination html<br />
       * pages are calculated using the registered scrolling style
       * 
       * @return XGrid_Plugin_Pagination_Structure
       */
      public function getStructure() {
          return $this->_structure;
      }
      
      private function _calculatePageCount() {
          return (integer) ceil($this->count() / $this->getItemCountPerPage());
      }

      /**
       * total number of pages
       * @return integer
       */
      public function getPageCount() {
          if (is_null($this->_pageCount)) {
              $this->_pageCount = $this->_calculatePageCount();
          }
          return $this->_pageCount;
      }

      /**
       * The zero-based index of first item to fetch.
       * 
       * @example
       * if there are 4 items and 2 items on per page, the 2nd page offset
       * shall be 2
       * 
       * @return integer 
       */
      public function getOffset() {
          return ($this->getCurrentPage() - 1) * $this->getItemCountPerPage();
      }

      /**
       * Returns a subset of pages within a given range.
       *
       * @param  integer $lowerBound Lower bound of the range
       * @param  integer $upperBound Upper bound of the range
       * @return array
       */
      public function getPagesInRange($lowerBound, $upperBound) {
          $lowerBound = $this->normalizePageNumber($lowerBound);
          $upperBound = $this->normalizePageNumber($upperBound);

          $pages = array();

          for ($pageNumber = $lowerBound; $pageNumber <= $upperBound; $pageNumber++) {
              $pages[$pageNumber] = $pageNumber;
          }

          return $pages;
      }

      /**
       * Brings the page number in range of the paginator.
       *
       * @param  integer $pageNumber
       * @return integer
       */
      public function normalizePageNumber($pageNumber) {
          $pageNumber = (integer) $pageNumber;

          if ($pageNumber < 1) {
              $pageNumber = 1;
          }

          $pageCount = $this->count();

          if ($pageCount > 0 && $pageNumber > $pageCount) {
              $pageNumber = $pageCount;
          }

          return $pageNumber;
      }

      /**
       * Creates the page collection.
       *
       * @return XGrid_Plugin_Pagination_Structure
       */
      public function createPages() {
          $pageCount = $this->getPageCount();
          $currentPageNumber = $this->getCurrentPage();

          $structure = new XGrid_Plugin_Pagination_Structure();
          $structure->setPageCount($pageCount);
          $structure->setItemCountPerPage($this->getItemCountPerPage());
          $structure->setFirst(1);
          $structure->setCurrent($currentPageNumber);
          $structure->setLast($pageCount);

          // Previous and next
          if ($currentPageNumber - 1 > 0) {
              $structure->setPrevious($currentPageNumber - 1);
          }
          
          if ($currentPageNumber + 1 <= $pageCount) {
              $structure->setNext($currentPageNumber + 1);
          }

          // Pages in range
          $scrollingStyle = $this->getScrollingStyle();
          $structure->setPagesInRange($scrollingStyle->getPages($this));
          $structure->setFirstPageInRange(min($structure->getPagesInRange()));
          $structure->setLastPageInRange(max($structure->getPagesInRange()));
          
          $this->_structure = $structure;          
      }

  }

  