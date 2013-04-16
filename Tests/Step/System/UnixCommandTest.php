<?php
namespace Kitpages\CommonStepBundle\Tests\Step\System;

use Kitpages\CommonStepBundle\Step\System\UnixCommand;

class UnixCommandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testUnixCommand()
    {
        $fileName = $this->exampleDir.'/test.tmp';
        touch($fileName);

        $event = $this->getMock('\Kitpages\ChainBundle\Step\StepEvent');
        $logger = $this->getMock('\Symfony\Component\HttpKernel\Log\NullLogger');

        $step = new UnixCommand();
        $step->setParameter("chdir", $this->exampleDir);
        $step->setParameter("command", "ls {{fileName}} {{gloubi}}");
        $step->setParameter("fileName", "test.tmp");
        $step->setService("logger", $logger);
        $return = $step->execute($event);

        $this->assertContains("test.tmp", $return);
        unlink($fileName);
        try {
            $return = $step->execute($event);
            $this->fail("No such file or directory");
        } catch (\RuntimeException $e) {
            $this->assertTrue(true);
        }
    }
}