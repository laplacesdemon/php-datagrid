<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The footer part of the table
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_HtmlHelper_TableFooter extends XGrid_HtmlHelper_TableHeader {

      
      public function __construct() {
          $this->setTag("tfoot");
          $this->_row = new XGrid_HtmlHelper_Item("tr");
      }
      

  }

  