<?php
/**
 * Created by Philippe Le Van.
 * Date: 13/02/13
 */
namespace Kitpages\CommonStepBundle\Step\Mail;

use Kitpages\ChainBundle\Step\StepAbstract;
use Kitpages\ChainBundle\Step\StepEvent;

/**
 * This class is used to copy a directory to another directory
 *
 * @example
 */
class NotificationMail
    extends StepAbstract
{
    public function execute(StepEvent $event = null)
    {
        $mailer = $this->getService("mailer");

        $message = \Swift_Message::newInstance()
            ->setSubject($this->getParameter("subject"))
            ->setFrom($this->getParameter("from"))
            ->setTo($this->getParameter("to"))
            ->setBody($this->getParameter("body"));

        $mailer->send($message);
    }
}
