<?php

  /**
   * A Flexible and extensible data grid
   * 
   * Phase 1:
   *    Creating the HTML structure
   *    Dispatching
   *    Plug-ins
   *    DataSources
   *    Filters
   *    Pagination Plugin
   * 
   * Phase 2:
   *    CrudStrategy
   *    Searchable plugin
   *    Sortable plugin
   * 
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid implements XGrid_Plugin_Interface {

      /**
       * Collection of XGrid_Plugin_Interface objects
       * @var array
       */
      protected $_plugins = array();
      
      /**
       * Collection of XGrid_DataField_Abstract objects
       * @var array
       */
      protected $_dataFields;
      
      /**
       * The data adapter reference
       * @var XGrid_DataSource_Interface
       */
      protected $_dataSource;
      
      /**
       * The crud strategy for inserting updating and deleting the data
       * @todo 
       * @var XGrid_CrudStrategy_Interface
       */
      protected $_crudStrategy;
      
      /**
       * The html structure helper
       * @var XGrid_HtmlHelper_CollectionInterface
       */
      private $_htmlHelper = null;
      
      /**
       * Notifies that the aookication is dispatched or not
       * @var type 
       */
      private $_isDispatched = false;

      /**
       * The constructor
       * Optional array of options make it easy to configure xgrid
       * @param array $options 
       */
      public function __construct($options = null) {
          $this->_initOptions($options);
          $this->init();
      }
      
      /**
       * Setting optional parameters for easy instantiation
       * @param type $options 
       */
      private function _initOptions($options = null) {
          // default parameters
          $params = array(
              'htmlHelper' => new XGrid_HtmlHelper_Default()
          );
          
          // override default parameters with the options
          if($options)
            $params = array_merge($params, $options);
          
          // set html helper
          if ($params['htmlHelper'] instanceof XGrid_HtmlHelper_Interface)
              $this->_htmlHelper = $params['htmlHelper'];
          else
              throw new XGrid_Exception(
                      'HtmlHelper should be an instance of XGrid_HtmlHelper_Interface');
          
          // set optional pagination plug in
          if(isset($params['pagination'])) {
              $paginator = (isset($params['pagination']['paginator']) && 
                                $params['pagination']['paginator'] instanceof XGrid_Plugin_Abstract) ? 
                    $params['pagination']['paginator'] :
                    new XGrid_Plugin_DefaultPaginator();
              
              $currentPage = (isset($params['pagination']['currentPage'])) ?
                        $params['pagination']['currentPage'] : 1;

              $perPage = (isset($params['pagination']['perPage'])) ? $params['pagination']['perPage'] : 20;
              $range = (isset($params['pagination']['range'])) ? $params['pagination']['range'] : 6;
              $baseUrl = (isset($params['pagination']['baseUrl'])) ? $params['pagination']['baseUrl'] : "";
              $type = (isset($params['pagination']['baseUrl'])) ? $params['pagination']['baseUrl'] : XGrid_Plugin_Pagination::SLIDING;
              
              $paginator->setCurrentPage($currentPage);
              $paginator->setItemCountPerPage($perPage);
              $paginator->setRange($range);
              $paginator->setType($type);
              $paginator->setBaseUrl($baseUrl);
              $this->registerPlugin($paginator);
          }
          
      }

      /**
       * The hook method for plugins
       */
      public function init() {
          foreach ($this->_plugins as $plugin) {
              $plugin->init();
          }
      }

      /**
       * The hook method for plugins
       */
      public function postDispatch() {
          foreach ($this->_plugins as $plugin) {
              $plugin->postDispatch();
          }
      }

      /**
       * The hook method for plugins
       */
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

          // check if at least one data field is added. otherwise add datafields 
          // from the data source automatically
          if(empty ($this->_dataFields)) {
              $current = $this->_dataSource->getIterator()->current();
              foreach ($current as $key => $val)
                  $this->addField($key, $key, XGrid_DataField::TEXT);
          }
          
          $this->preDispatch();
          $this->_htmlHelper->setData($this->getDataSource());
          $this->_htmlHelper->setColumns($this->getDataFields());
          $this->_htmlHelper->init();
          $this->postDispatch();

          $this->_isDispatched = true;
          return $this;
      }

      /**
       * Adds a data field. A data field represents the columns in the grid. <br />
       * Each data filed should be set explicitly in order to display in the data grid
       * 
       * @todo if no data field is set, add all supported fields in the datasource automatically.
       * @param string $index | the unique identifier of the column
       * @param string $key | the title column to be displayed in the table header
       * @param mixed $dataField | string or XGrid_DataField_Abstract instance
       * @param array $options | additional key value pairs
       * @param array $filters | collection of XGrid_Filter_Interface objects
       * @return XGrid 
       */
      public function addField($index, $title, $dataField, $options = null, $filters = null) {
          if ($dataField instanceof XGrid_DataField_Abstract) {

              if (!$dataField->getKey())
                  $dataField->setKey($index);

              $dataField->setTitle($title);
              $this->_dataFields[$index] = $dataField;
              return $this;
          } elseif (is_string($dataField)) {
              $this->_dataFields[$index] =
                      XGrid_DataField::create($dataField, $index, $title, $options, $filters);
          }

          return $this;
      }

      /**
       * Returns the datafield object 
       * null if not found
       * 
       * @param int or string $index
       * @return XGrid_DataField_Abstract or null
       */
      public function getDataField($index) {
          return (isset($this->_dataFields[$index])) ? $this->_dataFields[$index] :
                  null;
      }

      /**
       * Retuns the collection of XGrid_DataField_Abstract objects
       * @return array
       */
      public function getDataFields() {
          return $this->_dataFields;
      }

      /**
       * The data source provides the dataset for the grid body
       * 
       * @param XGrid_DataSource_Abstract $datasource 
       */
      public function setDataSource(XGrid_DataSource_Interface $datasource) {
          $this->_dataSource = $datasource;
          return $this;
      }

      /**
       * @return XGrid_DataSource_Interface 
       */
      public function getDataSource() {
          return $this->_dataSource;
      }

      /**
       * @param XGrid_HtmlHelper_Interface $helper 
       */
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
          return $this;
      }

      /**
       * The magic function to return grid xhtml
       * 
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

  