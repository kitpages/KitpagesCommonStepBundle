<?php
namespace Kitpages\CommonStepBundle\Tests\Console;

use Kitpages\ChainBundle\Tests\TestUtil\CommandTestCase;
use Kitpages\ChainBundle\ChainException;

class ConsoleTest extends CommandTestCase
{
    public function testRunCommandSimple()
    {
        $client = self::createClient();
        $testDir = "/tmp/testconfig";
        if (is_dir($testDir)) {
            rmdir($testDir);
        }
        $this->assertTrue(!is_dir($testDir));
        $output = $this->runCommand($client, "kitpages:chain:run-step common.unix.mkdir --p=dir:".$testDir);
        $this->assertTrue(is_dir($testDir));

    }
}