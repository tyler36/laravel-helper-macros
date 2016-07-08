<?php
use tyler36\HelperMacros\Helper;

/**
 * Class ValidatorTest
 *
 * @test
 * @group helper
 * @group validator
 */
class ValidatorTest extends TestCase
{
    /**
     * TEST:        Invalid validation
     *
     * @group error
     */
    public function testInvalidResponse()
    {
        $this->assertFalse(Helper::validate('20150230', 'date'));
    }


    /**
     * TEST:        Valid validation
     *
     * @group success
     */
    public function testValidResponse()
    {
        $this->assertTrue(Helper::validate('20150227', 'date'));
    }
}
