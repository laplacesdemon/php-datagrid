<?php

/**
 * @author Onur Yaman <onuryaman@gmail.com>
 * @group tmp
 */
class URLTest extends BaseTestCase {

    public function testBasicUsage() {
        $data = new stdClass();
        $data->text = 'Example URL';

        $instance = new XGrid_DataField_URL('text', array(
            'href' => 'http://example.com',
            'title' => 'Example URL'
        ));

        $this->assertEquals('<a href="http://example.com" title="Example URL">Example URL</a>', $instance->getValue($data));
    }

}