<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * The base class for the plugins
   *
   * @author suleyman [at] melikoglu.info
   */
  abstract class XGrid_Plugin_Abstract implements XGrid_Plugin_Interface {
   
      /**
       * The grid instance
       * @var XGrid
       */
      protected $_xgrid;
      
      public function getXgrid() {
          return $this->_xgrid;
      }

      public function setXgrid($_xgrid) {
          $this->_xgrid = $_xgrid;
      }

        
  }
