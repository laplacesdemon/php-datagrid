<?php

  /**
   * Description of Abstract
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
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
                        $this->filter($object->{$key->getKey()}, $object) : '';
              else 
                  return (isset($object->{$key->getKey()})) ? 
                    $this->_getFilteredValue($object->{$key->getKey()}, $key->getNext())
                            : '';

          } else {
              throw new XGrid_Exception("The key need to be a " .
                  "XGrid_DataField_LinkedList instance", 500);
          }
      }

      public function getValue($object) {
          return $this->_getFilteredValue($object, $this->getKey());
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