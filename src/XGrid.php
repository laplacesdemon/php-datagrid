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
       * The html structure helper
       * @var XGrid_HtmlHelper_CollectionInterface
       */
      private $_htmlHelper = null;
      
      private $_isDispatched = false;

      public function __construct($htmlHelper = null) {
          $this->_htmlHelper = (is_null($this->_htmlHelper)) ?
                  new XGrid_HtmlHelper_Default() : $htmlHelper;
          $this->init();
      }

      public function init() {
          foreach ($this->_plugins as $plugin) {
              $plugin->init();
          }
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
       * Pushes the plugin to the stack
       * @param XGrid_Plugin_Abstract $plugin 
       */
      public function registerPlugin(XGrid_Plugin_Abstract $plugin) {
          $plugin->setXgrid($this);
          array_push($this->_plugins, $plugin);
          return $this;
      }

      /**
       * Removes plugin from the stack
       * @param XGrid_Plugin_Abstract $plugin
       * @return XGrid 
       */
      public function removePlugin(XGrid_Plugin_Abstract $plugin) {
          foreach ($this->_plugins as $i => $p) {
              if ($plugin == $p)
                  unset($this->_plugins[$i]);
          }
          return $this;
      }

      public function isDispatched() {
          return $this->_isDispatched;
      }

      /**
       * Dispatches the grid by creating the xhtml structure
       * During the dispatch, runs the hook methods
       * returns the grid object
       */
      public function dispatch() {
          if (is_null($this->getDataSource()))
              throw new XGrid_Exception("No data source found. Please set one");

          
          $this->preDispatch();
          
          $this->_htmlHelper->setData($this->getDataSource());
          $this->_htmlHelper->setColumns($this->getDataFields());
          $this->_htmlHelper->init();
          
          $this->postDispatch();

          $this->_isDispatched = true;
          return $this;
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
          if ($dataField instanceof XGrid_DataField_Abstract) {
              $dataField->setKey($index);
              $dataField->setTitle($title);
              $this->_dataFields[$index] = $dataField;
              return $this;
          }

          if (is_string($dataField)) {
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
      
      /**
       * The html helper
       * this is a renderable htmlhelper item and has table parts 
       * (header, body, footer) in it
       * @return XGrid_HtmlHelper_CollectionInterface 
       */
      public function getHtmlHelper() {
          return $this->_htmlHelper;
      }

      /**
       * Adds attribute to the specified item
       * @todo only works for table element, implemented for other elements
       * 
       * @param string $key
       * @param string $value 
       */
      public function addAttribute($key, $value, $element = 'table') {
          // in order to add attributes to specific elements, we need to 
          // traverse though the html items
          $this->getHtmlHelper()->addAttribute($key, $value);
      }
      
      /**
       *
       * @return boolean
       * @todo implemented
       * @deprecated
       */
      public function hasPagination() {
          // return true if pagination plugin registered
          return false;
      }

      /**
       * The magic function to return grid xhtml
       * @return String
       */
      public function __toString() {
          if (!$this->isDispatched()) {
              //throw new XGrid_Exception("XGrid is not dispatched");
              $this->dispatch();
          }

          return $this->_htmlHelper->render();
      }

  }

  