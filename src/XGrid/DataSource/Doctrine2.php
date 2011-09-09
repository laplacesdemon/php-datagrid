<?php

/*
 * git@github.com:laplacesdemon/XGrid.git
 */

/**
 * Data source for the Doctrine 2 ORM framework
 *
 * @author Onur Yaman <onuryaman@gmail.com>
 */
class XGrid_DataSource_Doctrine2 implements XGrid_DataSource_Interface {
    /**
     * @var \Doctrine\ORM\Query
     */
    private $_query;
    private $_rowCount = null;

    public function __construct(\Doctrine\ORM\Query $query) {
        $this->_query = $query;
    }

    private function setRowCount() {
        if (is_integer($this->_rowCount)) {
            return $this;
        } elseif ($this->_query instanceof \Doctrine\ORM\Query) {
            // @todo is execution ok here? performance issues may arise!
            $this->_rowCount = $this->_query->execute()->rowCount();
        } else {
            throw new XGrid_Exception('Invalid doctrine query', 500);
        }

        return $this;
    }

    public function count() {
        if (is_null($this->_rowCount)) {
            $this->setRowCount();
        }
        return $this->_rowCount;
    }

    public function getDecoratableObject() {
        return $this->_query;
    }

    public function getIterator() {
        return new XGrid_DataSource_ArrayIterator(
            $this->_query->getResult()
        );
    }
}