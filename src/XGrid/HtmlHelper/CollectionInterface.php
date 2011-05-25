<?php

  /*
   * 
   */

  /**
   *
   * @author suleyman [at] melikoglu.info
   */
  interface XGrid_HtmlHelper_CollectionInterface extends XGrid_HtmlHelper_Interface {
      
      /**
       *
       * @return XGrid_HtmlHelper_Item
       */
      public function getHeader();

      /**
       *
       * @return XGrid_HtmlHelper_Item
       */
      public function getBody();

      /**
       *
       * @return XGrid_HtmlHelper_Item
       */
      public function getFooter();
      
  }

