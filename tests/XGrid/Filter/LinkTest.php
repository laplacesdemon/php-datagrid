<?php

  /*
   * 
   */

  /**
   * Description of Appender
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_Filter_LinkTest extends BaseTestCase {

      public function testAppenderFilter($name, $url) {
          
          $name = 'myLinkId';
          $urlScheme = '/{lang}/support/detail/{id}';
          $attributes = array('class' => 'myClass');
          $filter = new XGrid_Filter_Link($url);
          $filter->addParam('lang', 'en');
          $filter->addParam('id', new XGrid_DataField_Text('id'));
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "click me";
          $res = $class->filter($val);
          $this->assertEquals("<a id='/en/support/detail/2' class='myClass'>click me</a>", $res);
      }
      
  
  }

