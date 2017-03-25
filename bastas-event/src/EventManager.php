<?php
/**
 * Created by PhpStorm.
 * User: nikitas
 * Date: 27/2/2017
 * Time: 20:30
 */

namespace Bastas\Event;


use Bastas\Event\Exception\EventManagerException;

final class EventManager
{
    private $listeners = [];

    private function eventFactory($eventName, $callback, $priority)
    {
        return new Event($eventName, $callback, $priority);
    }

    private function triggerListeners($eventName)
    {
        foreach ($this->listeners[$eventName] as $listener) {
            if ($listener->getCallback() instanceof \Closure) {

                $listener->getCallback()->call($listener->getTargetInstance(), $listener);
            } else {

                if (!method_exists($listener->getCallback()[0], $listener->getCallback()[1])) {
                    throw new EventManagerException('Callback method with name: "' . $listener->getCallback()[1] . '" does not exist');
                }

                $listener->getCallback()[0]->{$listener->getCallback()[1]}($listener);
            }

            if (false === $listener->getPropagationStatus()) {
                break;
            }
        }
    }

    private function sortEventsByPriority($eventName)
    {
        usort($this->listeners[$eventName], array($this, "sortByPriority"));
    }

    private function sortByPriority($a, $b)
    {
        return $a->getPriority() < $b->getPriority();
    }

    private function setPropertiesToEvents($eventName, $targetInstance, $options)
    {
        foreach ($this->listeners[$eventName] as $listener) {
            $listener->setTargetInstance($targetInstance);
            $listener->setOptions($options);
        }
    }

    public function emitEvent($eventName, $targetInstance, $options = [])
    {
        $this->setPropertiesToEvents($eventName, $targetInstance, $options);
        $this->sortEventsByPriority($eventName);
        $this->triggerListeners($eventName);
    }

    public function attachListener($eventName, $callback, $priority = 0)
    {
        $this->listeners[$eventName][] = $this->eventFactory($eventName, $callback, $priority);
    }
}