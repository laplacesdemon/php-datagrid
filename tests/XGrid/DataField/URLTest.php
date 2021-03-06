<?php

/**
 * @author Onur Yaman <onuryaman@gmail.com>
 * @group tmp
 */
class UrlTest extends BaseTestCase {

    public function testBasicUsage() {
        $data = new stdClass();
        $data->url = 'http://example.com';

        $instance = new XGrid_DataField_Url('url');

        $this->assertEquals('<a href="http://example.com">http://example.com</a>', $instance->getValue($data));
    }

    public function testComplexUsage() {
        $data = new stdClass();
        $data->url = 'http://example.com';

        $instance = new XGrid_DataField_Url('url', array(
            'title' => 'Example URL'
        ));
        $instance->setDisplayText('Example URL');

        $this->assertEquals('<a href="http://example.com" title="Example URL">Example URL</a>', $instance->getValue($data));
    }

}