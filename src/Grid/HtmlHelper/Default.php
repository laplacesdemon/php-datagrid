<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of Default
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class OS_Grid_HtmlHelper_Default implements OS_Grid_HtmlHelper_Interface {
      
      public function closeBody() {
          return "</tbody>";
      }
      public function closeBodyField() {
          return "</td>";
      }
      public function closeBodyRow() {
          return "</tr>";
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
          return "<thead>";
      }
      public function createHeadField() {
          return "<th>";
      }
      public function createHeadRow() {
          return "<tr>";
      }
      public function createTable() {
          return "<table>";
      }

      public function closeTable() {
          return "</table>";
      }
  }
