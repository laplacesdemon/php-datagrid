<?php
  /**
   * Creates an input field structure
   * @usage
		$actions = new XGrid_Zend_DataField_Form(
                $this->view, 
                "actions", 
                array(
                    "controller" => "user", 
                    "action" => "delete"));

        $actions->addSubmit("delete", "Delete User");
        $actions->addHidden("id", "{%id}"); // this will give the id property in the dataset if there is any
		$grid->addField("actions", "Actions", $actions);
   */
  class XGrid_Zend_Filter_Input extends XGrid_Filter_Abstract {
      
	  const TEXT = "text";
	  const PASSWORD = "password";
	  const UPLOAD = "upload";
	  const BUTTON = "button";
	  const SUBMIT = "submit";
	  const HIDDEN = "hidden";

      private $_view;
      private $_type;
	  private $_name;
	  private $_value;
      private $_attributes;

	  /**
		* Creates the input html structure
		*
		* @param Zend_View $view
		* @param string $type | input type, use constants in this class
		* @param string $name | the input name
		* @param string $value | default value
		* @param array $attributes | html attributes
		*/
      public function __construct(Zend_View $view, $type, $name, $value = "", $attributes = array()) {
          $this->_view = $view;
          $this->_type = $type;
          $this->_name = $name;
          $this->_value = $value;
          $this->_attributes = $attributes;
      }
      
      public function filter($value, $row = null) {          		
		  $atts = '';
          foreach ($this->_attributes as $key => $val) {
              $atts .= $key . '="' . $val . '"';
          }
          
          $value = ($value) ? $value : $this->_value;
          return '<input id="' . $this->_name . '" name="' . $this->_name . '" 
					type="' . $this->_type . '" value="' . $this->_filter($this->_value, $row) . '" ' . $atts . ' />';
      }
  }

