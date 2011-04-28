<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * DataSource adapter interface provides the data for displaying into the grid
   * 
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface XGrid_DataSource_Interface extends Countable, IteratorAggregate {
      
      /**
       * returns the internal decoratable object.
       * This object will be polymorphically different for each concrete implementation
       */
      public function getDecoratableObject();
      
  }
