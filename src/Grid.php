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
  class OS_Grid implements OS_Grid_Plugin_Interface {

      /**
       * collection of OS_Grid_Plugin_Interface objects
       * @var array
       */
      protected $_plugins = array();
      
      /**
       * Collection of OS_Grid_DataField_Abstract objects
       * @var array
       */
      protected $_dataFields;

      /**
       * the data adapter
       * @var OS_Grid_DataSource_Interface
       */
      protected $_dataSource;
      
      /**
       * the crud strategy for inserting updating and deleting the data
       * @var OS_Grid_CrudStrategy_Interface
       */
      protected $_crudStrategy;
      
      /**
       * xhtml parts for header, body and footer
       * @var array
       */
      private $_xhtmlParts = "";
      
      /**
       * The html structure helper
       * @var OS_Grid_HtmlHelper_Interface
       */
      private $_htmlHelper = null;
            
      public function __construct($htmlHelper = null) {
          $this->_htmlHelper = (is_null($this->_htmlHelper)) ? 
                  new OS_Grid_HtmlHelper_Default() : $htmlHelper;
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
              $this->_xhtmlParts["head"] .= $dataField->getKey();
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
          foreach ($this->getDataSource() as $data) {
              $this->_xhtmlParts["body"] .= $this->_htmlHelper->createBodyRow(); // <tr>
              foreach ($data as $item) {
                  $this->_xhtmlParts["body"] .= $this->_htmlHelper->createBodyField(); // <td>
                  $this->_xhtmlParts["body"] .= $item;
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
       * @return OS_Grid 
       */
      public function addDataField($index, $key, $dataField, $options = null, $filters = null) {
          if($dataField instanceof OS_Grid_DataField_Abstract) {
              $dataField->setKey($key);
              $this->_dataFields[$index] = $dataField;
              return $this;
          }
          
          if(is_string($dataField)) {
              $this->_dataFields[$index] = OS_Grid_DataField::create($dataField, $key, $options, $filters);
          }
          
          return $this;
      }
      
      /**
       * returns the datafield object 
       * null if not found
       * @param int or string $index
       * @return OS_Grid_DataField_Abstract or null
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
       * @param OS_Grid_DataSource_Interface $datasource 
       */
      public function setDataSource(OS_Grid_DataSource_Interface $datasource) {
          $this->_dataSource = $datasource;
          return $this;
      }
      
      public function getDataSource() {
          return $this->_dataSource;
      }
      
      public function setHtmlHelper(OS_Grid_HtmlHelper_Interface $helper) {
          $this->_htmlHelper = $helper;
      }
      
      /**
       * The magic function to return grid xhtml
       * @return String
       */
      public function __toString() {
          return implode("", $this->_xhtmlParts);          
      }

  }

  