<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * the link filter used for wrapping the data and turns it into an anchor html link
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_Link extends XGrid_Filter_Abstract {
      
      private $_url;
      
      /**
       * html atts
       * @var string 
       */
      private $_attributes;
      
      /**
       * default text
       * @var string
       */
      private $_linkText;

      /**
       *
       * @param string $url
       * @param string $attributes | html attributes
       * @param string $linkText | default text
       */
      public function __construct($url, $attributes = array(), $linkText = null) {
          $this->_url = $url;
          $this->_attributes = $attributes;
          $this->_linkText = $linkText;
      }
      
      /**
       *
       * @param string $value
       * @param string $row
       * @return string 
       */
      public function filter($value, $row = null) {
          $atts = '';
          foreach ($this->_attributes as $key => $val) {
              $atts .= $key . '="' . $val . '" ';
          }
          
          $value = ($this->_linkText) ? $this->_linkText : $value;
          return '<a ' . $atts . 'href="' . $this->_url . '" >' . $value . '</a>';
      }
  }

