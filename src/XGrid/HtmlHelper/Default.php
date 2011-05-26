<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The html helper is used for creating the html structure
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_HtmlHelper_Default extends XGrid_HtmlHelper_Item implements XGrid_HtmlHelper_CollectionInterface {

      /**
       *
       * @var array
       */
      private $_dataFields;
      
      /**
       *
       * @var XGrid_DataSource_Interface
       */
      private $_data;
      
      /**
       *
       * @var XGrid_HtmlHelper_TableHeader 
       */
      private $_header;
      
      /**
       *
       * @var XGrid_HtmlHelper_TableBody
       */
      private $_body;
      
      
      /**
       *
       * @var XGrid_HtmlHelper_TableFooter
       */
      private $_footer;

      public function __construct() {
          parent::__construct("table");
      }
      
      /**
       * the data to display. usually displayed on the body section of table
       */
      public function setData(XGrid_DataSource_Interface $data) {
          $this->_data = $data;
      }

      /**
       * Collection of XGrid_DataField_Abstract objects
       * 
       * @param array $datafields 
       */
      public function setColumns($datafields) {
          $this->_dataFields = $datafields;
      }
      
      /**
       *
       * @return XGrid_HtmlHelper_TableHeader 
       */
      public function getHeader() {
          return $this->_header;
      }

      public function setHeader($_header) {
          $this->_header = $_header;
      }

      public function getBody() {
          return $this->_body;
      }

      public function setBody($_body) {
          $this->_body = $_body;
      }

      public function getFooter() {
          return $this->_footer;
      }

      public function setFooter($_footer) {
          $this->_footer = $_footer;
      }
      
      public function init() {
          $this->_prepareHeader();
          $this->_prepareBody();
          $this->_prepareFooter();
      }
      
      private function _prepareHeader() {
          $this->_header = new XGrid_HtmlHelper_TableHeader();
          $this->_header->setColumns($this->_dataFields);
      }
      
      private function _prepareBody() {
          $this->_body = new XGrid_HtmlHelper_TableBody();
          $this->_body->setData($this->_data);
          $this->_body->setColumns($this->_dataFields);
      }
      
      private function _prepareFooter() {
          $this->_footer = new XGrid_HtmlHelper_TableFooter();
      }
      
      public function render() {
          $this->append($this->getHeader());
          $this->append($this->getBody());
          $this->append($this->getFooter());
          return parent::render();
      }

  }

  