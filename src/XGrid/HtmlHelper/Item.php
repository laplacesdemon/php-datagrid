<?php

  /*
   * 
   */

  /**
   * Description of Item
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_HtmlHelper_Item implements XGrid_HtmlHelper_Interface {

      protected $_tag;
      
      protected $_value = array();
      
      protected $_appender = array();
      
      protected $_prepender = array();
      
      protected $_attributes = array();
      
      public function __construct($tag = "") {
          $this->_tag = $tag;
      }
      
      public function init() {
          
      }
      
      public function append($data, $index = null) {
          
          if(!is_null($index)) {
              if(!isset($this->_appender[$index])) {
                  $this->_appender[$index] = "";
              }
              
              if(is_array($this->_appender[$index])) {
                  array_push($this->_appender[$index], $data);
              } elseif($this->_appender[$index] instanceof XGrid_HtmlHelper_Item) {
                  $this->_appender[$index]->append($data);
              }
              return $this;
          } 
          
          array_push($this->_appender, $data);
          
          return $this;
      }

      public function prepend($data, $index = null) {
          array_unshift($this->_prepender, $data);
          return $this;
      }

      protected function _render($collection) {
          $r = "";
          foreach ($collection as $d) {
              if($d instanceof XGrid_HtmlHelper_Item)
                $r .= $d->render();    
              else
                $r .= $d;
          }
          return $r;
      }


      public function render() {
          $r = "<" . $this->_tag;
          
          foreach ($this->_attributes as $key => $value) {
              $r .= " " . $key . "='" . $value . "'";
          }
          
          $r .= ">";
          
          $r .= $this->_render($this->_prepender);
          $r .= $this->_render($this->_value);
          $r .= $this->_render($this->_appender);
          
          $r .= "</" . $this->_tag . ">";
          
          return $r;
      }

      public function setTag($tag) {
          $this->_tag = $tag;
          return $this;
      }

      public function setValue($data) {
          array_push($this->_value, $data);
          return $this;
      }

      public function addAttribute($key, $value) {
          $this->_attributes[$key] = $value;
          return $this;
      }

  }

  