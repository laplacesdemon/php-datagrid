<?php

  /*
   * 
   */

  /**
   * Description of Sliding
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class XGrid_Plugin_Pagination_ScrollingStyle_Sliding implements XGrid_Plugin_Pagination_ScrollingStyle_Interface {

      /**
       * returns collection of pages in sliding format
       * 
       * @param XGrid_Plugin_Pagination_Abstract $pagination
       * @return array
       */
      public function getPages(XGrid_Plugin_Pagination_Abstract $pagination) {
          $pageRange = $pagination->getRange();
          
          $pageNumber = $pagination->getCurrentPage();
          $pageCount = $pagination->getPageCount();

          if ($pageRange > $pageCount) {
              $pageRange = $pageCount;
          }

          $delta = ceil($pageRange / 2);

          if ($pageNumber - $delta > $pageCount - $pageRange) {
              $lowerBound = $pageCount - $pageRange + 1;
              $upperBound = $pageCount;
          } else {
              if ($pageNumber - $delta < 0) {
                  $delta = $pageNumber;
              }

              $offset = $pageNumber - $delta;
              $lowerBound = $offset + 1;
              $upperBound = $offset + $pageRange;
          }

          return $pagination->getPagesInRange($lowerBound, $upperBound);
      }

  }

  