<?php
  /**
   * creates form html
   *
   */
  class XGrid_Zend_DataField_Form extends XGrid_DataField_Abstract {
   
      private $_internalFilters = array();
      private $_seperator = ' ';

	  private $_view;
	
	  private $_formName;
	  private $_formAction;
	  private $_formMethod;

	  /**
		* creates the form data field instance 
		*
		* @param Zend_View $view
		* @param string $name | form name
		* @param array $routerParams | array to create the action url (controller, action)
		* @param string $method | form method
		*/
      public function __construct(Zend_View $view, $name, $routerParams = array(), $method = "get") {
          $this->_view = $view;
		  $this->_formName = $name;
		  $this->_formAction = $this->_view->url($routerParams);
		  $this->_formMethod = $method;
      }
      
      public function addInput(XGrid_Filter_Abstract $filter) {
          array_push($this->_internalFilters, $filter);      
          return $this;
      }
      
	  /**
		* helper method to add a new input field to the form
		*/
      public function addInputText($name, $value = "", $attributes = array()) {
          $filter = new XGrid_Zend_Filter_Input($this->_view, XGrid_Zend_Filter_Input::TEXT, $name, $value, $attributes);
          return $this->addInput($filter);
      }

	  /**
		* helper method to add a new input field to the form
		*/
      public function addButton($name, $value = "", $attributes = array()) {
          $filter = new XGrid_Zend_Filter_Input($this->_view, XGrid_Zend_Filter_Input::BUTTON, $name, $value, $attributes);
          return $this->addInput($filter);
      }

	  /**
		* helper method to add a new input field to the form
		*/
      public function addSubmit($name, $value = "", $attributes = array()) {
          $filter = new XGrid_Zend_Filter_Input($this->_view, XGrid_Zend_Filter_Input::SUBMIT, $name, $value, $attributes);
          return $this->addInput($filter);
      }

	  /**
		* helper method to add a new input field to the form
		*/
      public function addHidden($name, $value = "", $attributes = array()) {
          $filter = new XGrid_Zend_Filter_Input($this->_view, XGrid_Zend_Filter_Input::HIDDEN, $name, $value, $attributes);
          return $this->addInput($filter);
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
          
          return '<form name="' . $this->_formName . '" method="' . $this->_formMethod . '" action="' . $this->_formAction . '">' . implode($this->getSeperator(), $res) . "</form>";
      }
      
  }
