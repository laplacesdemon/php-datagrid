<?php

  /**
   * Abstract class for the data fields. 
   *
   * @author suleyman [at] melikoglu.info
   */
  abstract class XGrid_DataField_Abstract implements XGrid_Filter_Interface, XGrid_HtmlHelper_Renderable {

      /**
       * The data title, used on the table header
       * @var String
       */
      protected $_title;
      /**
       * The data key, used as tjhe unique identifier of a column
       * @var string
       */
      protected $_key = null;
      /**
       * Collection of options as key value pairs
       * @var array
       */
      protected $_options = array();
      /**
       * Collection of XGrid_Filter_Interface objects
       * @var array
       */
      protected $_filters = array();
      
      protected $_disableFilters = false;
      
      protected $_defaultText = '';

      private $_observers = array();


      /**
       * The setter of datafield key, used for the identifier of the data column
       * @param type $key
       * @return XGrid_DataField_Abstract 
       */
      public function setKey($key) {
          $tmp = new XGrid_DataField_LinkedList();
          $tmp->setKey($key);
          if (!$this->_key) {
              $this->_key = $tmp;
          } else {
              $this->_key->setKey($tmp);
          }

          return $this;
      }

      /**
       * The getter of datafield key, used for the identifier of the data column
       * @return XGrid_DataField_LinkedList 
       */
      public function getKey() {
          return $this->_key;
      }

      /**
       * The recursive datafield key. It is used for fetching the value from 
       * the nested object. Use this if you have nested stdClass 
       * @param mixed $key 
       */
      public function addKey($key) {
          $tmp = new XGrid_DataField_LinkedList();
          $tmp->setKey($key);
          if($this->_key instanceof XGrid_DataField_LinkedList) {
              $this->_key->setNext($tmp);
          } else {
              $this->_key = $tmp;
          }
          
          return $this;
      }

      /**
       * the title of the data column
       * @return string
       */
      public function getTitle() {
          return $this->_title;
      }

      /**
       * The setter of the data column title.
       * @param string $_title 
       */
      public function setTitle($_title) {
          $this->_title = $_title;
      }

      public function getDefaultText() {
          return $this->_defaultText;
      }

      public function setDefaultText($_defaultText) {
          $this->_defaultText = $_defaultText;
          return $this;
      }
      
      /**
       * Array of options. Options are simple key value pairs
       * @param array $options 
       * @return XGrid_DataField_Abstract 
       */
      public function setOptions($options) {
          $this->_options = $options;
          return $this;
      }

      /**
       * Add a single option
       * @param string $key
       * @param string $value
       * @return XGrid_DataField_Abstract 
       */
      public function addOption($key, $value) {
          $this->_options[$key] = $value;
          return $this;
      }

      /**
       * Array of options. Options are simple key value pairs
       * @return array
       */
      public function getOptions() {
          return $this->_options;
      }

      /**
       * Collection of XGrid_Filter_Interface objects
       * @param array $filters 
       */
      public function setFilters($filters) {
          $this->_filters = $filters;
          return $this;
      }

      /**
       * Adds a sinle filter object
       * @param XGrid_Filter_Interface $filter
       * @return XGrid_DataField_Abstract 
       */
      public function addFilter(XGrid_Filter_Interface $filter) {
          array_push($this->_filters, $filter);
          return $this;
      }

      public function getFilters() {
          return $this->_filters;
      }

      /**
       * implements the XGrid_Filter_Interface
       * @param string $value 
       */
      public function filter($value, $row = null) {
          foreach ($this->getFilters() as $filter) {
              $value = $filter->filter($value, $row);
          }
          return $value;
      }
      
      public function disableFilters() {
          return $this->_disableFilters;
      }

      /**
       * temporarily disables the filter for the render
       * @param type $_disableFilters
       * @return XGrid_DataField_Abstract 
       */
      public function setDisableFilters($_disableFilters) {
          $this->_disableFilters = $_disableFilters;
          return $this;
      }

      public function render() {
          return $this->getTitle();
      }
      
      protected function _getFilteredValue($object, $key = null) {
          if(!$object) {
              return;
          }
          
          if($key instanceof XGrid_DataField_LinkedList) {
              if(is_null($key->getNext())) 
                  return (isset($object->{$key->getKey()})) ? 
                    $this->filter($object->{$key->getKey()}, $object) : $this->getDefaultText();
              else 
                  return (isset($object->{$key->getKey()})) ? 
                    $this->_getFilteredValue($object->{$key->getKey()}, $key->getNext())
                            : $this->getDefaultText();

          } else {
              throw new XGrid_Exception("The key need to be a " .
                  "XGrid_DataField_LinkedList instance", 500);
          }
      }

      public function getValue($object) {
          if(sizeof($this->_observers) > 0) {
              $event = new XGrid_DataField_Event();
              $event->setData($object);
              $event->setDataField($this);
              foreach ($this->_observers as $name => $func) {
                  $event->setName($name);
                  $object = $func($event);
              }
              $return = ($this->disableFilters()) ? $object : $this->filter($object);
              $this->setDisableFilters(false);
              return $return;
          } else {
              return $this->_getFilteredValue($object, $this->getKey());
          }
      }
      
      public function registerOnRender($func) {
          $this->_observers['onRow'] = $func;
      }
      
  }

  class XGrid_DataField_LinkedList {

      private $_next = null;
      private $_key = null;

      /**
       *
       * @return XGrid_DataField_LinkedList 
       */
      public function getNext() {
          return $this->_next;
      }

     /**
      *
      * @param XGrid_DataField_LinkedList $obj 
      */
      public function setNext(XGrid_DataField_LinkedList $obj) {
          $this->_next = $obj;
      }

      /**
       *
       * @return string 
       */
      public function getKey() {
          return $this->_key;
      }

      /**
       *
       * @param string $_key 
       */
      public function setKey($_key) {
          $this->_key = $_key;
      }

      public function __toString() {
          return $this->getKey();
      }
  
  }
  
  class XGrid_DataField_Event {
      
      /**
       * the event name
       * @var string
       */
      private $_name;
      
      /**
       * raw data
       * @var stdClass
       */
      private $_data;
      
      /**
       * the actual datafield object
       * @var XGrid_DataField_Abstract
       */
      private $_dataField;
      
      public function getName() {
          return $this->_name;
      }

      public function setName($_name) {
          $this->_name = $_name;
      }

      public function getData() {
          return $this->_data;
      }

      public function setData($_data) {
          $this->_data = $_data;
      }

      public function getDataField() {
          return $this->_dataField;
      }

      public function setDataField($_dataField) {
          $this->_dataField = $_dataField;
      }

    }