<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   *
   * @author suleyman [at] melikoglu.info
   */
  interface XGrid_Plugin_Interface {
   
      /**
       * Hook method
       * Called during the early instantiation of the XGrid
       */
      public function init();
      
      /**
       * Hook method
       * called after the initialization is complete 
       * and before the dispatch() method. 
       * it can be use for setting additional parameters
       */
      public function preDispatch();
      
      /**
       * Hook method
       * called after the dispatch() method. it means the xhtml structure is 
       * already created. 
       * it can be used for adding additional javascript files.
       */
      public function postDispatch();
      
  }
