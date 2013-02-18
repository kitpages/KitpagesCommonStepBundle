<?php
/**
 * Created by Philippe Le Van.
 * Date: 13/02/13
 */
namespace Kitpages\CommonStepBundle\Step\FileSystem;

use Kitpages\ChainBundle\Step\StepAbstract;
use Kitpages\ChainBundle\Step\StepEvent;

/**
 * This class is used to copy a directory to another directory
 *
 * @example
 */
class RemoveDirectory
    extends StepAbstract
{
    protected $parameterList = array(
        "dir" => null
    );
    private function rmdirr($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file)) {
                $this->rmdirr($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
    }
    public function execute(StepEvent $event = null)
    {
        $dir = $this->getParameter("dir");
        if (!is_dir($dir)) {
            return false;
        }
        $this->rmdirr($dir);
        return true;
    }
}
