<?php

  /*
   * 
   */

  /**
   * Description of Abstract
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  abstract class XGrid_Pagination_Abstract implements XGrid_DataSource_Interface {
   
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
  }
