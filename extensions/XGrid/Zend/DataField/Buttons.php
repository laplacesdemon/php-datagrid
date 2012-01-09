<?php
  /**
   * Adds an anchor link as a new datafield
   * @usage
    	  $buttons = new OS_XGrid_Zend_DataField_Buttons();
          $buttons->addKey('id')
            ->setButton(new OS_XGrid_Zend_Filter_Link($this->view, 
                      array(
                          'controller' => 'advert', 
                          'lang' => $this->lang,
                          'action' => 'delete',
                          'id' => '{%id}'
                      ), array('class' => 'delete'), $this->translate->_("Sil")
                  ))
            // alternatively you can add the link with the following method.
            //->setZendLink($this->view, 'Details', 'details', 'id', array('class' => 'details'))
            ->setSeperator(' | ');

			$xgrid->addField('buttons', $this->translate->_('Actions'), $buttons);
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
          $filter = new XGrid_Zend_Filter_Link($view, 
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
