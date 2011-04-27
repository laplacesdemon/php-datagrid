<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of DataField
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_DataField {

      const TEXT        = "text";
      const DATE        = "date";
      const DROPDOWN    = "dropdown";
      const ANCHOR      = "anchor";
      
      /**
       * Factory method to create datafield instances
       * throws XGrid_Exception if the type cannot be found
       * @param string $type
       * @param array $options
       * @param array $filters 
       * @return XGrid_DataField_Abstract
       */
      public static function create($type, $key, $options = null, $filters = null) {
          $cls = null;
          
          switch ($type) {
              case self::TEXT:
                  $cls = new XGrid_DataField_Text();
                  break;
              case self::TEXT:
                  $cls = new XGrid_DataField_Date();
                  break;
          }
          
          if(is_null($cls))
              throw new XGrid_Exception("Unknown data field type: " . $type);
              
          $cls->setKey($key);
          
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
