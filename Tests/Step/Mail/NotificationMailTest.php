<?php
namespace Kitpages\CommonStepBundle\Tests\Step\Mail;

use Kitpages\CommonStepBundle\Step\Mail\NotificationMail;

class NotificationMailTest extends \PHPUnit_Framework_TestCase
{
    public function testUnixCommand()
    {
        $event = $this->getMock('\Kitpages\ChainBundle\Step\StepEvent');
        $mailer = $this
            ->getMockBuilder('\Swift_Mailer')
            ->disableOriginalConstructor()
            ->getMock();

        $step = new NotificationMail();
        $step->setParameter("from", "toto@hotmail.com");
        $step->setParameter("to", "bob@hotmail.com");
        $step->setParameter("subject", "[notification] {{number}}");
        $step->setParameter("body", "Body content");

        $step->setService("mailer", $mailer);

        $return = $step->execute($event);
    }
}