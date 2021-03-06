<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The default paginator. The paginator limits the data set and injects 
   * paginator html structure to the footer. 
   *
   * @author suleyman [at] melikoglu.info
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
      
      protected $_range = 6;


      /**
       * paginator strategy type 
       * use constants in XGrid_Plugin_Pagination class
       * @var type 
       */
      protected $_type;
      
      private $_baseUrl = null;
      
      private $_xhtml = "";
      
      /**
       * the identifier string for a page to append to querystring
       * @var string
       */
      private $_pageUrlIdentifier = "p";

      /**
       * the range is available for some pagination types like "sliding"
       * 
       * @param int $currentPage
       * @param int $perPage
       * @param int $range
       * @param string $type 
       */
      public function __construct($currentPage = 1, $perPage = 10, $range = 6, $type = XGrid_Plugin_Pagination::SLIDING) {
          $this->setCurrentPage($currentPage);
          $this->setItemCountPerPage($perPage);
          $this->setRange($range);
          $this->setType($type);
      }
      
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

      public function setBaseUrl($baseUrl) {
          $this->_baseUrl = $baseUrl;
      }

      public function getBaseUrl($data = null) {
          if($data) {
              if(strpos($this->_baseUrl, "?")) {
                  // @todo we're deleting the older query string parameters
                  // this is certanly a bug
                  return $this->_baseUrl . http_build_query($data);
              } else {
                  return $this->_baseUrl . "?" . http_build_query($data);
              }
          } else {
              return $this->_baseUrl;
          }
      }

      public function init() {
          if (is_null($this->_baseUrl)) {
              $this->_baseUrl = $_SERVER["REQUEST_URI"];
          }
      }

      public function preDispatch() {
          if(!$this->_paginator)
            $this->_paginator = XGrid_Plugin_Pagination_Factory::create($this->getXgrid()->getDataSource());
          $this->_paginator->setCurrentPage($this->getCurrentPage());
          $this->_paginator->setItemCountPerPage($this->getItemCountPerPage());
          $this->_paginator->setRange($this->getRange());
          
          // override the datasource
          $this->getXgrid()->setDataSource($this->_paginator);
          
          // set the scrolling style
          if(is_null($this->_paginator->getScrollingStyle())) {
              // fallback to default paginator
              $this->_paginator->setScrollingStyle(
                      new XGrid_Plugin_Pagination_ScrollingStyle_Sliding()
              );
          }
          
          $this->_paginator->createPages();
      }

      public function postDispatch() {
          // inject pagination html to footer
          $this->_prepareHtml();
          
          $this->getXgrid()->getHtmlHelper()->getFooter()->append($this->_xhtml);
      }

      private function _prepareHtml() {
          if (!$this->_paginator->getPageCount())
              return "";
          
          $structure = $this->_paginator->getStructure();
          
          $columnCount = sizeof($this->getXgrid()->getDataFields());
          
          $this->_xhtml = "<tr><td colspan='" . $columnCount . "' ><div class='paginationControl'>";
          
          // previous page 
          if($structure->getPrevious()) {
              $this->_xhtml .= "<a href='" . $this->getBaseUrl(array($this->_pageUrlIdentifier => $structure->getPrevious())) . "'>&lt; Previous</a> | ";
          } else {
              $this->_xhtml .= "<span class='disabled'>&lt; Previous</span> | ";
          }
          
          // numbered page links
          foreach ($structure->getPagesInRange() as $page) {
              if($page != $structure->getCurrent()) {
                  $this->_xhtml .= "<a href='" . $this->getBaseUrl(array($this->_pageUrlIdentifier => $page)) . "'>$page</a> | ";
              } else {
                  $this->_xhtml .= $page . " | ";
              }
          }
          
          // next page 
          if($structure->getNext()) {
              $this->_xhtml .= "<a href='" . $this->getBaseUrl(array($this->_pageUrlIdentifier => $structure->getNext())) . "'>Next &gt;</a>";
          } else {
              $this->_xhtml .= "<span class='disabled'>Next &gt;</span>";
          }
          
          $this->_xhtml .= "</div></td></tr>";
          
      }

      

  }

  