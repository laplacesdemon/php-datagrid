<?php

/**
 * @author Onur Yaman <onuryaman@gmail.com>
 * @group tmp
 */
class DateTimeTest extends BaseTestCase {

    public function testBasicUsage() {
        $data = new stdClass();
        $data->datetime = '2011-06-02 17:23:00';

        $instance = new XGrid_DataField_DateTime();
        $instance->addKey("datetime");
        $instance->setFormat('d.m.Y H:i:s'); // if does not set, falls back to default format

        $this->assertEquals("02.06.2011 17:23:00", $instance->getValue($data));
    }

    public function testBasicUsageFailScenerio() {
        $data = new stdClass();
        $data->theDate = strtotime("illegal date");

        $instance = new XGrid_DataField_DateTime();
        $instance->addKey("datetime");
        $instance->setFormat('d.m.Y H:i:s'); // if does not set, falls back to default format

        $this->assertEquals("", $instance->getValue($data));
    }

}