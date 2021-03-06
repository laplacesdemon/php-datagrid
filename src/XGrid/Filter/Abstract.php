<?php
  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The abstract class adds additional logic to filter data
   *
   * @author suleyman [at] melikoglu.info
   */
  abstract class XGrid_Filter_Abstract implements XGrid_Filter_Interface {
      
      protected function _filter($val, $row = null) {
          if(!$row)
              return $val;
          
          $pos = strpos($val, '{%');    
          if($pos === false)
              return $val;
          
          $pos = $pos + 2;
          $length = strpos($val, '}') - $pos;
          $theField = substr($val, $pos, $length);
          
          if($theField){
              if(!isset($row->{$theField}))
                  return $val;
              
              $ret = str_replace('{%' . $theField . '}', $row->{$theField}, $val); 
              if(strpos($ret, '{%'))
                  return $this->_filter($ret, $row);
              else
                  return $ret;
          } else {
              return $val;
          }
      }
      
  }
