<?php

namespace Dtc\QueueBundle\Model;

abstract class Worker
{
    protected $jobManager;
    protected $jobClass;
    protected $job;

    /**
     * @return string
     */
    public function getJobClass()
    {
        return $this->jobClass;
    }

    /**
     * @param string $jobClass
     */
    public function setJobClass($jobClass)
    {
        $this->jobClass = $jobClass;
    }

    /**
     * @param JobManagerInterface $jobManager
     */
    public function setJobManager(JobManagerInterface $jobManager)
    {
        $this->jobManager = $jobManager;
    }

    /**
     * @return
     */
    public function getJobManager()
    {
        return $this->jobManager;
    }

    /**
     * @param \DateTime|null $dateTime
     * @param bool $batch
     * @param int|null $priority
     *
     * @return mixed
     */
    public function at($dateTime = null, $batch = false, $priority = null)
    {
        if (null === $dateTime) {
            $dateTime = new \DateTime();
        }

        return new $this->jobClass($this, $batch, $priority, $dateTime);
    }

    /**
     * @param int $delay    Amount of time to delay in seconds
     * @param int|null $priority
     */
    public function later($delay = 0, $priority = null)
    {
        return $this->batchOrLaterDelay($delay, false, $priority);
    }

    public function batchOrLaterDelay($delay = 0, $batch = false, $priority = null)
    {
        $dateTime = new \DateTime();
        if ($delay) {
            $dateTime->modify("+{$delay} seconds");
        }
        $job = $this->at($dateTime, $batch, $priority);
        $job->setDelay($delay);

        return $job;
    }

    /**
     * @param int      $delay    Amount of time to delay
     * @param int|null $priority
     */
    public function batchLater($delay = 0, $priority = null)
    {
        return $this->batchOrLaterDelay($delay, true, $priority);
    }

    /**
     * @param \DateTime|null $dateTime
     * @param int|null $priority
     */
    public function batchAt($dateTime = null, $priority = null)
    {
        return $this->at($dateTime, true, $priority);
    }

    abstract public function getName();
}
