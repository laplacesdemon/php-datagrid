<?php

  /*
   * 
   */

  /**
   * Description of e
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Filter_ZendLink extends XGrid_Filter_Abstract {
      
      private $_view;
      private $_arr;
      private $_attributes;


      public function __construct(Zend_View $view, $arr, $attributes = array()) {
          $this->_view = $view;
          $this->_arr = $arr;
          $this->_attributes = $attributes;
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
          
          return '<a ' . $atts . ' href="' . $this->_view->url($arr) . '" >' . $value . '</a>';
      }
  }

