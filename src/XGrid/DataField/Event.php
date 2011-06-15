<?php

  /**
   * Data field events are triggered on the rendering state of the data field
   *
   * @author suleyman [at] melikoglu.info
   */
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
