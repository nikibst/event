<?php
/**
 * Created by PhpStorm.
 * User: nikitas
 * Date: 27/2/2017
 * Time: 20:29
 */

namespace Bastas\Event;


final class Event
{
    private $eventName = '';
    private $targetInstance = null;
    private $options = [];
    private $callback;
    private $priority = 0;
    private $propagate = true;

    public function __construct($eventName, $callback, $priority)
    {
        $this->setEventName($eventName);
        $this->setCallback($callback);
        $this->setPriority($priority);
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * @return mixed
     */
    public function getTargetInstance()
    {
        return $this->targetInstance;
    }

    /**
     * @param mixed $targetInstance
     */
    public function setTargetInstance($targetInstance)
    {
        $this->targetInstance = $targetInstance;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getPropagationStatus()
    {
        return $this->propagate;
    }

    public function stopPropagation()
    {
        $this->propagate = false;
    }
}