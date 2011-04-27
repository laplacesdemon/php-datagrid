<?php

  /**
   * Description of Abstract
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  abstract class XGrid_DataField_Abstract implements XGrid_Filter_Interface {
   
      /**
       * The data key, used on the table header
       * as well as the identifier for the data column
       * @var String
       */
      protected $_key;
      
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
          $this->_key = $key;
          return $this;
      }
      
      /**
       * The getter of datafield key, used for the identifier of the data column
       * @return type 
       */
      public function getKey() {
          return $this->_key;
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
      public function filter($value) {
          foreach ($this->getFilters() as $filter) {
              $value = $filter->filter($value);
          }
          return $value;
      }

      /**
       * Returns the xhtml output
       */
      public abstract function render();
      
  }