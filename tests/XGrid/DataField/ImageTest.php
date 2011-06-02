<?php

/**
 * @author Onur Yaman <onuryaman@gmail.com>
 * @group tmp
 */
class ImageTest extends BaseTestCase {

    public function testBasicUsage() {
        $data = new stdClass();
        $data->image = 'http://bil-kazan.creasoup.com/public/img/logo/creasoup.png';

        $instance = new XGrid_DataField_Image();
        $instance->addKey("image");
        $instance->setFormat('<img src="%s" alt="Brand Logo" title="Brand Logo" />'); // if does not set, falls back to default format

        $this->assertEquals('<img src="http://bil-kazan.creasoup.com/public/img/logo/creasoup.png" alt="Brand Logo" title="Brand Logo" />', $instance->getValue($data));
    }

    public function testBasicUsageFailScenerio() {
        $data = new stdClass();
        $data->image = "illegal image";

        $instance = new XGrid_DataField_Image();
        $instance->addKey("image");
        $instance->setFormat('<img src="%s" alt="Brand Logo" title="Brand Logo" />'); // if does not set, falls back to default format

        $this->assertEquals('', $instance->getValue($data));
    }

}