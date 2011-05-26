<?php
  /**
   * Description of LinkTest
   *
   * @author suleyman [at] melikoglu.info
   */
  class XGrid_Filter_LinkTest extends BaseTestCase {
   
      public function testBasicUsage() {
          $expected = '<a class="myclass" href="http://localhost/mypage" >The value</a>';
          
          $linkFilter = new XGrid_Filter_Link('http://localhost/mypage', array('class' => 'myclass'));
          $result = $linkFilter->filter('The value');
          
          $this->assertEquals($expected, $result);
      }
      
      public function testBasicUsageWithDefaultValue() {
          $expected = '<a class="myclass" href="http://localhost/mypage" >My default text</a>';
          
          $linkFilter = new XGrid_Filter_Link('http://localhost/mypage', array('class' => 'myclass'), 'My default text');
          $result = $linkFilter->filter('The value');
          
          $this->assertEquals($expected, $result);
      }
      
      public function testBasicUsageWithMultipleAttributes() {
          
          $expected = '<a class="myclass" style="height:100px" href="http://localhost/mypage" >The value</a>';
          
          $linkFilter = new XGrid_Filter_Link('http://localhost/mypage', array('class' => 'myclass', 'style' => 'height:100px'));
          $result = $linkFilter->filter('The value');
          
          $this->assertEquals($expected, $result);
      }
  }
