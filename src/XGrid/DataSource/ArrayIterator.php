<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * internal iterator for array datasource
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataSource_ArrayIterator extends ArrayIterator {
   
      public function current() {
          $val = parent::current();
          if(is_array($val)) {
              return (object) $val;
          } else {
              return $val;
          }
      }
      
  }
