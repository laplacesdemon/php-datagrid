<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface OS_Grid_Plugin_Interface {
   
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
