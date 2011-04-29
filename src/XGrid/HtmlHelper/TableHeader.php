<?php

  /*
   * 
   */

  /**
   * Description of TableHeader
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_HtmlHelper_TableHeader extends XGrid_HtmlHelper_Item {

      protected $_row = null;
      
      public function __construct() {
          parent::__construct("thead");
          $this->_row = new XGrid_HtmlHelper_Item("tr");
      }
      
      /**
       * data fields / columns. these fields are the meta descriptions for the
       * columns. Usually listed on the table header 
       * 
       * @param $datafields array
       * @see XGrid_DataField_abstract
       */
      public function setColumns($datafields) {
          foreach ($datafields as $datafield) {
              $this->addColumn($datafield);
          }
          $this->append($this->_row);
      }
      
      public function addColumn(XGrid_DataField_Abstract $column) {
          $c = new XGrid_HtmlHelper_Item("th");
          $c->append($column->render());
          $this->_row->append($c);
      }

  }

  