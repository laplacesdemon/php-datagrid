<?php

  /*
   * 
   */

  /**
   * The common config for XGrid
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Config {

      /**
       * Autoloader for XGrid
       * Please use this autoloader in your standalone projects.
       * Most of the times you do not need to register this autoloader. Use
       * it if you have class not found errors.
       * 
       * @example 
       * require 'XGrid/Config.php';
       * spl_autoload_register(array('XGrid_Config', 'xgridAutoload'));
       * 
       * @param type $className
       * @return type 
       */
      public static function xgridAutoload($className) {
          if (class_exists($className, false) || interface_exists($className, false))
              return false;

          $class = str_replace('_', '/', $className) . '.php';
          include_once $class;
          return true;
      }

  }

  