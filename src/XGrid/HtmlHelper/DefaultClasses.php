<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Default
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_HtmlHelper_DefaultClasses implements XGrid_HtmlHelper_Interface {
  
      private $_options = array(
          "tableClass" => "",
          "headClass" => "",
          "bodyClass" => "",
          "footerClass" => "",
          "trClass" => "",
          "trOddClass" => "",
          "trEvenClass" => "",
          "thClass" => "",
          "tdClass" => ""
      );
      
      public function __construct($options = array()) {
          // @todo
      }
      
      public function closeBody() {
          return "</body>";
      }
      public function closeBodyField() {
          return "</td>";
      }
      public function closeBodyRow() {
          return "</tbody>";
      }
      public function closeFooter() {
          return "</tfoot>";
      }
      public function closeFooterField() {
          return "</td>";
      }
      public function closeFooterRow() {
          return "</tr>";
      }
      public function closeHead() {
          return "</thead>";
      }
      public function closeHeadField() {
          return "</th>";
      }
      public function closeHeadRow() {
          return "</tr>";
      }
      public function createBody() {
          return "<tbody>";
      }
      public function createBodyField() {
          return "<td>";
      }
      public function createBodyRow() {
          return "<tr>";
      }
      public function createFooter() {
          return "<tfoot>";
      }
      public function createFooterField() {
          return "<td>";
      }
      public function createFooterRow() {
          return "<tr>";
      }
      public function createHead() {
          return "<table>";
      }
      public function createHeadField() {
          return "<th>";
      }
      public function createHeadRow() {
          return "<tr>";
      }
      public function createTable() {
          return "<table class='" . $this->_options[""] . "' >";
      }

      public function closeTable() {
          
      }
  }
