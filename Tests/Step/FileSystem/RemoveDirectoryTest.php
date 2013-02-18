<?php
namespace Kitpages\CommonStepBundle\Tests\Step\FileSystem;

use Kitpages\CommonStepBundle\Step\FileSystem\RemoveDirectory;

class RemoveDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testRemoveDir()
    {
        $buildDir = $this->exampleDir.'/buildDir';
        $fileName = $buildDir.'/test.txt';
        if (!is_dir($buildDir)) {
            mkdir($buildDir);
            mkdir($buildDir.'/subdir');
            touch($buildDir.'/subdir/file.txt');
        }
        touch($fileName);
        $this->assertTrue(is_dir($buildDir));
        $step = new RemoveDirectory();
        $step->setParameter("dir", $fileName);
        $this->assertFalse($step->execute());
        $this->assertTrue(is_file($fileName));


        $step->setParameter("dir", $buildDir);
        $this->assertTrue($step->execute());
        $this->assertFalse(is_dir($buildDir));
    }
}