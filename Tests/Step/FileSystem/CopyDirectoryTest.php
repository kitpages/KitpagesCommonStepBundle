<?php
namespace Kitpages\CommonStepBundle\Tests\Step\FileSystem;

use Kitpages\CommonStepBundle\Step\FileSystem\CopyDirectory;
use Kitpages\CommonStepBundle\Step\System\UnixCommand;

class CopyDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testCreateDir()
    {
        $event = $this->getMock('\Kitpages\ChainBundle\Step\StepEvent');
        $logger = $this->getMock('\Symfony\Component\HttpKernel\Log\NullLogger');

        $step = new CopyDirectory();
        $step->setParameter("src_dir", $this->exampleDir.'/commonSrcDir');
        $step->setParameter("dest_dir", $this->exampleDir.'/buildDir');
        $step->setService("logger", $logger);
        $step->execute($event);

        $compareStep = new UnixCommand();
        $compareStep->setParameter("command", "diff -q {{src_dir}} {{dest_dir}}");
        $compareStep->setParameter("src_dir", $step->getParameter("src_dir"));
        $compareStep->setParameter("dest_dir", $step->getParameter("dest_dir").'/css');
        $compareStep->setService("logger", $logger);
        try {
            $compareStep->execute($event);
            $this->fail("directory should be different");
        } catch (\RuntimeException $e) {
            $this->assertTrue(true);
        }
        $compareStep->setParameter("dest_dir", $step->getParameter("dest_dir"));
        try {
            $compareStep->execute($event);
            $this->assertTrue(true);
        } catch (\RuntimeException $e) {
            $this->fail("directory should be equals");
        }
    }
}