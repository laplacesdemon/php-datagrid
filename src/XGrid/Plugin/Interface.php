<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface XGrid_Plugin_Interface {
   
      /**
       * Hook method
       * called before the dispatch() method. 
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
