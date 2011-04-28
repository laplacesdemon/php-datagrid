<?php

  /*
   * 
   */

  /**
   * Description of ArrayIterator
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
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
