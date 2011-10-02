<?php

  /**
   * Description of Doctrine
   *
   * @author Onur Yaman <onuryaman@gmail.com>
   */
  class XGrid_Plugin_Pagination_Doctrine2 extends XGrid_Plugin_Pagination_Doctrine {

      public function getIterator() {
          $this->getDecoratableObject()
                  ->setMaxResults($this->getItemCountPerPage())
                  ->setFirstResult($this->getOffset());
          return $this->_datasource->getIterator();
      }

  }

  