<?php
  /**
   * The most simple data field. Just puts the raw data to the record. 
   * This data field is also the default field if no fields are explicitly
   * added to the xgrid
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataField_Text extends XGrid_DataField_Abstract {
         
      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

  }
