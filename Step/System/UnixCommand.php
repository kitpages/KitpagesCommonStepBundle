<?php
/**
 * Created by Philippe Le Van.
 * Date: 15/02/13
 */
namespace Kitpages\CommonStepBundle\Step\System;

use Kitpages\ChainBundle\Step\StepAbstract;
use Kitpages\ChainBundle\Step\StepEvent;

use Symfony\Component\Process\Process;

/**
 * This class is used to...
 *
 * @example
 */
class UnixCommand
    extends StepAbstract
{
    public function execute(StepEvent $event = null)
    {
        $logger = $this->getService("logger");
        // change to chdir
        $dir = $this->getParameter("chdir");
        if ($dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                $logger->info("dir $dir created");
            }
            chdir($dir);
        }

        // change params
        $command = $this->getRenderedParameter("command", function($str) {return escapeshellarg($str);} );
        $logger->info("command=".$command);

        $process = new Process($command);
        $process->setTimeout(3600);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        $event->set("process", $process);

        return $process->getExitCode();
    }
}
