<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of Text
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_DataField_Text extends XGrid_DataField_Abstract {
         
      public function __construct($key = null) {
          if(!is_null($key)) $this->setKey ($key);
      }

      public function render() {
          return $this->getTitle();
      }

      public function getValue($object, $key = null) {
          if(!isset($key)) {
              $key = $this->getKey();
          }
          
          if($key instanceof XGrid_DataField_LinkedList) {
              
              if(is_null($key->getNext())) 
                  return $this->filter($object->{$key->getKey()});
              else 
                  return $this->getValue($object->{$key->getKey()}, $key->getNext());

          } else {
              throw new XGrid_Exception("The key need to be a " .
                  "XGrid_DataField_LinkedList instance", 500);
          }
      }
  }
