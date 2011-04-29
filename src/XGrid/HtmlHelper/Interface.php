<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  interface XGrid_HtmlHelper_Interface extends XGrid_HtmlHelper_Renderable {

      /**
       * if the $index param is null, appends at the end of rows
       * otherwise inserts it after the specified row
       */
      public function append($data, $index = null);
      
      /**
       * prepends the data before the content
       */
      public function prepend($data, $index = null);
      
      /**
       * The item value
       */
      public function setValue($data);
      
      /**
       * The main tag
       */
      public function setTag($tag);
      
      /**
       * The attribute for the main tag
       */
      public function addAttribute($key, $value);
      
  }
