<?php
  /**
   * Creates an anchor link html
   * @usage
			 new OS_XGrid_Zend_Filter_Link($this->view, 
             array(
                 'controller' => 'advert', 
                 'lang' => $this->lang,
                 'action' => 'delete',
                 'id' => '{%id}'
             )
   *
   */
  class XGrid_Zend_Filter_Link extends XGrid_Filter_Abstract {
      
      private $_view;
      private $_arr;
      private $_attributes;
      private $_linkText;

	  /**
		* Creates the anchor link html structure
		*
		* @param Zend_View $view | the zend view
		* @param array $routerParams | the router params (controller, action, etc)
		* @param array $attributes | the html attributes
		* @param string $linkText | the visible text of the anchor link
		*/
      public function __construct(Zend_View $view, $routerParams, $attributes = array(), $linkText = null) {
          $this->_view = $view;
          $this->_arr = $routerParams;
          $this->_attributes = $attributes;
          $this->_linkText = $linkText;
      }
      
      public function filter($value, $row = null) {
          $arr = array();
          foreach ($this->_arr as $key => $val) {
              $arr[$key] = $this->_filter($val, $row);
          }
          
          $atts = '';
          foreach ($this->_attributes as $key => $val) {
              $atts .= $key . '="' . $val . '"';
          }
          
          $value = ($this->_linkText) ? $this->_linkText : $value;
          return '<a ' . $atts . ' href="' . $this->_view->url($arr) . '" >' . $value . '</a>';
      }
  }

