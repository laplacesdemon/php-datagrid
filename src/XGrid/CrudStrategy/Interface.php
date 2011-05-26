<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */
  
  /**
   * The CRUD Stragy has not been developed yet
   * 
   * The classes that implement this interface shall be used for inserting, deleting 
   * and updating the data
   * 
   * @author suleyman [at] melikoglu.info
   */
  interface XGrid_CrudStrategy_Interface {
      
      public function onInsert($data);
      
      public function onUpdate($key, $data);
      
      public function onDelete($key);
  }
