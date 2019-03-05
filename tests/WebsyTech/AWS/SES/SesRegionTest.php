<?php

use WebsyTech\AWS\SES\BulkTemplatedEmail;
use WebsyTech\AWS\SES\Destination;
use WebsyTech\AWS\SES\Email;
use WebsyTech\AWS\SES\SES;
use WebsyTech\AWS\SES\Template;

class SesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * The ses object will be used in all/most of the tests.
     */
    public function setUp()
    {
          $this->ses = new SES();
    }

    /**
     * Asserts that the ses->region method returns the default region when called.
     * default region is us-east-1
     * @return void
     */
    public function testSesGetRegion()
    {
        $region = $this->ses->region();
        $this->assertTrue($region == "us-east-1");
    }

    /**
     * Assert that setting the region works with any type that can be converted to string.
     * IN FUTURE RELEASE, ONLY VALID REGIONS WILL BE ACCEPTED.
     * @return void
     */
    public function testSesSetRegion()
    {
        $newRegion = "us-west-1"; // string is a string.
        $this->setRegion($newRegion);

        $newRegion = 1; // integer can be converted to string.
        $this->setRegion($newRegion);

        $newRegion = true; // bool can be converted to string.
        $this->setRegion($newRegion);

        $newRegion = 2.1234; // floating point can be converted to string.
        $this->setRegion($newRegion);

        // Need to test the 'Resource' type
    }

    /**
     * Called by other tests.
     * Asserts that setting a region actually works with the input given.
     * Asserts that region comes back as a string.
     * @param string $newRegion A string or a type that can be converted to a string.
     */
    private function setRegion($newRegion)
    {
        $this->ses->region($newRegion); // Set region.
        $region = $this->ses->region(); // Get region.
        $this->assertTrue($region == $newRegion); // Compare region.
        $this->assertInternalType("string", $region);
    }

    /**
     * Asserts that a TypeError exception is thrown when using an array.
     * @return void
     */
    public function testSesSetRegionFailureWithArray()
    {
        $this->expectException(TypeError::class); // Expect a type error exception.
        $newRegion = []; // Array cannot be converted to string.
        $this->ses->region($newRegion); // Set region.
    }

    /**
     * Asserts that a TypeError exception is thrown when using an object.
     * @return void
     */
    public function testSesSetRegionFailureWithObject()
    {
        $this->expectException(TypeError::class); // Expect a type error exception.
        $newRegion = new StdClass();
        $this->ses->region($newRegion);
    }

    /**
     * Assert that passing null doesn't change the region to null.
     * @return void
     */
    public function testSesSetRegionWithNull()
    {
        $region1 = $this->ses->region();
        $region2 = $this->ses->region(null);
        $this->assertTrue($region1 == $region2);
    }
}

?>
