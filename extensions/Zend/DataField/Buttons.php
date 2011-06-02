<?php
  /**
   * Description of Buttons
   *
   */
  class XGrid_Zend_DataField_Buttons extends XGrid_DataField_Abstract {
   
      private $_internalFilters = array();
      private $_seperator = ' ';

      public function __construct() {
          
      }
      
      public function setButton(XGrid_Filter_Abstract $filter) {
          array_push($this->_internalFilters, $filter);      
          return $this;
      }
      
      public function setZendLink(Zend_View $view, $title, $action = 'edit', $dataField = 'id', $attributes = array()) {
          $filter = new XGrid_Filter_Zend_Link($view, 
                      array(
                          'action' => $action,
                          'id' => "{%$dataField}"
                      ), $attributes, $title
                  );
          return $this->setButton($filter);
      }
            
      public function setSeperator($seperator) {
          $this->_seperator = $seperator;
          return $this;
      }
      
      public function getSeperator() {
          return $this->_seperator;
      }
      
      public function getValue($object) {
          $id = parent::getValue($object);
          
          $res = array();
          
          foreach ($this->_internalFilters as $filter) {
              array_push($res, $filter->filter($id, $object));
          }
          
          return implode($this->getSeperator(), $res);
      }
      
  }
