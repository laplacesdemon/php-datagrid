<?php
  /**
   * Fully functional data grid
   * 
   * Phase 1:
   * 
   * Phase 2:
   *    crusStrategy
   *    Pagination
   *    Searchable plugin
   *    Sortable plugin
   * 
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid implements XGrid_Plugin_Interface {

      /**
       * collection of XGrid_Plugin_Interface objects
       * @var array
       */
      protected $_plugins = array();
      
      /**
       * Collection of XGrid_DataField_Abstract objects
       * @var array
       */
      protected $_dataFields;

      /**
       * the data adapter
       * @var XGrid_DataSource_Interface
       */
      protected $_dataSource;
      
      /**
       * the crud strategy for inserting updating and deleting the data
       * @var XGrid_CrudStrategy_Interface
       */
      protected $_crudStrategy;
      
      /**
       * xhtml parts for header, body and footer
       * @var array
       */
      private $_xhtmlParts = "";
      
      /**
       * The html structure helper
       * @var XGrid_HtmlHelper_Interface
       */
      private $_htmlHelper = null;
      
      private $_pagination_currentPage = null;
      
      private $_pagination_itemCountPerPage = null;
            
      public function __construct($htmlHelper = null) {
          $this->_htmlHelper = (is_null($this->_htmlHelper)) ? 
                  new XGrid_HtmlHelper_Default() : $htmlHelper;
      }


      public function postDispatch() {
          foreach ($this->_plugins as $plugin) {
              $plugin->postDispatch();
          }
      }

      public function preDispatch() {
          foreach ($this->_plugins as $plugin) {
              $plugin->preDispatch();
          }
      }
      
      /**
       * Dispatches the grid by creating the xhtml structure
       * During the dispatch, runs the hook methods
       * returns the grid object
       */
      public function dispatch() {
          if(is_null($this->getDataSource()))
                  throw new XGrid_Exception("No data source found. Please set one");
          
          $this->_createPagination();
          
          $this->preDispatch();
          $this->_prepareHead();
          $this->_prepareBody();
          $this->_prepareFooter();
          $this->postDispatch();
          return $this;
      }
      
      /**
       * Prepares the header part of the grid
       * Iterates through all registered data fields
       */
      protected function _prepareHead() {
          $this->_xhtmlParts["head"] = $this->_htmlHelper->createTable(); // <table>
          $this->_xhtmlParts["head"] .= $this->_htmlHelper->createHead(); // <thead>
          $this->_xhtmlParts["head"] .= $this->_htmlHelper->createHeadRow(); // <tr>
          foreach ($this->_dataFields as $dataField) {
              $this->_xhtmlParts["head"] .= $this->_htmlHelper->createHeadField(); // <td>
              $this->_xhtmlParts["head"] .= $dataField->getTitle();
              $this->_xhtmlParts["head"] .= $this->_htmlHelper->closeHeadField(); // </td>
          }
          $this->_xhtmlParts["head"] .= $this->_htmlHelper->closeHeadRow(); // </tr>
          $this->_xhtmlParts["head"] .= $this->_htmlHelper->closeHead(); // </thead>
          return $this->_xhtmlParts["head"];
      } 
      
      /**
       * Prepares the body part of the grid
       * Iterates through all items
       */
      protected function _prepareBody() {
          $this->_xhtmlParts["body"] = $this->_htmlHelper->createBody(); // <tbody>
          foreach ($this->getDataSource()->getIterator() as $data) {
              $this->_xhtmlParts["body"] .= $this->_htmlHelper->createBodyRow(); // <tr>
              foreach ($this->_dataFields as $datafield) {
                  $this->_xhtmlParts["body"] .= $this->_htmlHelper->createBodyField(); // <td>
                  
                  $this->_xhtmlParts["body"] .= $data->{$datafield->getKey()};
                  
                  $this->_xhtmlParts["body"] .= $this->_htmlHelper->closeBodyField(); // </td>
              }
              
              
              $this->_xhtmlParts["body"] .= $this->_htmlHelper->closeBodyRow();
          }
          $this->_xhtmlParts["body"] .= $this->_htmlHelper->closeBody(); // </tbody>
          return $this->_xhtmlParts["body"]; 
      }
      
      /**
       * Prepares the footer part
       */
      protected function _prepareFooter() {
          $this->_xhtmlParts["footer"] = $this->_htmlHelper->createFooter(); // <tfoot>
          $this->_xhtmlParts["footer"] .= $this->_htmlHelper->closeFooter(); // </thead>
          $this->_xhtmlParts["footer"] .= $this->_htmlHelper->closeTable(); // </table>
          return $this->_xhtmlParts["footer"];
      }
      
      /**
       *
       * @param type $index
       * @param type $key
       * @param type $dataField
       * @param type $options
       * @param type $filters
       * @return XGrid 
       */
      public function addDataField($index, $title, $dataField, $options = null, $filters = null) {
          if($dataField instanceof XGrid_DataField_Abstract) {
              $dataField->setKey($index);
              $dataField->setTitle($title);
              $this->_dataFields[$index] = $dataField;
              return $this;
          }
          
          if(is_string($dataField)) {
              $this->_dataFields[$index] = 
                      XGrid_DataField::create($dataField, $index, $title, $options, $filters);
          }
          
          return $this;
      }
      
      /**
       * returns the datafield object 
       * null if not found
       * @param int or string $index
       * @return XGrid_DataField_Abstract or null
       */
      public function getDataField($index) {
          return (isset($this->_dataFields[$index])) ? $this->_dataFields[$index] : 
              null;
      }
      
      public function getDataFields() {
          return $this->_dataFields;
      }
      
      /**
       * The data source provides the dataset for the grid body
       * @param XGrid_DataSource_Abstract $datasource 
       */
      public function setDataSource(XGrid_DataSource_Interface $datasource) {
          $this->_dataSource = $datasource;
          return $this;
      }
      
      /**
       *
       * @return XGrid_DataSource_Interface 
       */
      public function getDataSource() {
          return $this->_dataSource;
      }
      
      public function setHtmlHelper(XGrid_HtmlHelper_Interface $helper) {
          $this->_htmlHelper = $helper;
      }
      
      public function hasPagination() {
          return is_null($this->_pagination_currentPage) ? false : true;
      }
      
      /**
       * Pagination settings
       * Use constants in XGrid_Pagination class for the $type 
       * 
       * @param integer $currentPage the current page value
       * @param integer $itemsPerPage count of items per page
       * @param string $type 
       * @param integer $range 
       * @return XGrid 
       */
      public function setPagination($currentPage = 1, $itemsPerPage = 20, 
              $type = XGrid_Pagination::ELASTIC, $range = 6) 
      {
          $this->_pagination_currentPage = $currentPage;
          $this->_pagination_itemCountPerPage = $itemsPerPage;
          //@todo set type and range
          return $this;
      }
      
      private function _createPagination() {
          $pagination = XGrid_Pagination_Factory::create($this->getDataSource());
          $pagination->setCurrentPage($this->_pagination_currentPage);
          $pagination->setItemCountPerPage($this->_pagination_itemCountPerPage);
          $this->setDataSource($pagination);
      }
      
      /**
       * The magic function to return grid xhtml
       * @return String
       */
      public function __toString() {
          return implode("", $this->_xhtmlParts);          
      }

  }

  