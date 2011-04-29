<?php

  /*
   * 
   */

  /**
   * Description of TableHeader
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_HtmlHelper_TableFooter extends XGrid_HtmlHelper_TableHeader {

      
      public function __construct() {
          $this->setTag("tfoot");
          $this->_row = new XGrid_HtmlHelper_Item("tr");
      }
      

  }

  