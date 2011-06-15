<?php
  
  /**
   * Tests of the XGrid_Filter_Substring
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class SubstringTest extends BaseTestCase {
      
      public function testUsage() {
          $string = 'lorem ipsum dolor sit amed.';
          $start = 6;
          $length = 5;
          $instance = new XGrid_Filter_Substring($start, $length);
          
          $expected = 'ipsum';
          $this->assertEquals($expected, $instance->filter($string));
          
      }
      
  }
