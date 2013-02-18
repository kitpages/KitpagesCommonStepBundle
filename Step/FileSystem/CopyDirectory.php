<?php
/**
 * Created by Philippe Le Van.
 * Date: 13/02/13
 */
namespace Kitpages\CommonStepBundle\Step\FileSystem;

use Kitpages\CommonStepBundle\Step\System\UnixCommand;

/**
 * This class is used to copy a directory to another directory
 *
 * @example
 */
class CopyDirectory
    extends UnixCommand
{
    protected $parameterList = array(
        "command" => "rm -rf {{dest_dir}} ; cp -rp {{src_dir}} {{dest_dir}}",
        "src_dir" => null,
        "dest_dir" => null
    );
}
