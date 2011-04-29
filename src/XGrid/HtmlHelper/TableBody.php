<?php

  /*
   * 
   */

  /**
   * Description of TableBody
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_HtmlHelper_TableBody extends XGrid_HtmlHelper_Item {

      private $_dataFields;
      private $_data;

      public function __construct() {
          parent::__construct("tbody");
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

      public function render() {
          foreach ($this->_data->getIterator() as $d) {
              $row = new XGrid_HtmlHelper_Item("tr");
              foreach ($this->_dataFields as $field) {
                  if (!isset($d->{$field->getKey()}))
                      continue;
                  $c = new XGrid_HtmlHelper_Item("td");
                  $c->append($d->{$field->getKey()});
                  $row->append($c);
              }
              $this->append($row);
          }
          return parent::render();
      }

  }

  