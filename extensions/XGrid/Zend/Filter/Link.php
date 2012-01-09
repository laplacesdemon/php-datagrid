<?php
  /**
   * Description of e
   *
   */
  class XGrid_Zend_Filter_Link extends XGrid_Filter_Abstract {
      
      private $_view;
      private $_arr;
      private $_attributes;
      private $_linkText;


      public function __construct(Zend_View $view, $arr, $attributes = array(), $linkText = null) {
          $this->_view = $view;
          $this->_arr = $arr;
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

