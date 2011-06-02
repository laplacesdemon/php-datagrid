<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The data filed factory that encapsulates the creation of data field instances.
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_DataField {

      const TEXT        = "XGrid_DataField_Text";
      const DATE        = "XGrid_DataField_DefaultDate";
      const DROPDOWN    = "dropdown";
      const ANCHOR      = "anchor";
      const CHECKBOX    = "XGrid_DataField_Checkbox";
      const DATETIME	= "XGrid_DataField_DateTime";
      
      /**
       * Factory method to create datafield instances
       * throws XGrid_Exception if the type cannot be found
       * @param string $type
       * @param array $options
       * @param array $filters 
       * @return XGrid_DataField_Abstract
       */
      public static function create($type, $key, $title, $options = null, $filters = null) {
          $cls = null;
          
          try {
              $cls = new $type;
          } catch (Exception $e) {
              //@todo is there any 'class not found' exception?
              throw new XGrid_Exception("Unknown data field type: " . $type);
          }
              
          $cls->setKey($key);
          $cls->setTitle($title);
          
          if(!is_null($options))
              $cls->setOptions($options);
          
          if(!is_null($filters)) {
              if(is_array($filters)) {
                  $cls->setFilters($filters);
              } elseif($filters instanceof XGrid_Filter_Interface) {
                  $cls->addFilter($filters);
              }
          }
          
          return $cls;
      }
  
  }
