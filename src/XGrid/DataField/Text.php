<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Text
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataField_Text extends XGrid_DataField_Abstract {
         
      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

  }
