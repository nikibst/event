<?php
/**
 * Created by PhpStorm.
 * User: nikitas
 * Date: 27/2/2017
 * Time: 20:30
 */

namespace Bastas\Event;


interface EventManagerAwareInterface
{
    public function setEventManager(EventManager $eventManager);
    public function getEventManager();
}