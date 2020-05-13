<?php

namespace Dtc\QueueBundle\Entity;

use Dtc\GridBundle\Annotation as Grid;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseJob extends \Dtc\QueueBundle\Model\RetryableJob
{
    /**
     * @Grid\Column(order=1,sortable=true,searchable=true)
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Grid\Column(sortable=true, searchable=true)
     * @ORM\Column(type="string", name="worker_name")
     */
    protected $workerName;

    /**
     * @Grid\Column(sortable=true, searchable=true)
     * @ORM\Column(type="string", name="class_name")
     */
    protected $className;

    /**
     * @Grid\Column(sortable=true, searchable=true)
     * @ORM\Column(type="string")
     */
    protected $method;

    /**
     * @Grid\Column(sortable=true, searchable=true)
     * @ORM\Column(type="string")
     */
    protected $status;

    /**
     * @ORM\Column(type="text")
     */
    protected $args;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $batch;

    /**
     * @Grid\Column(sortable=true, searchable=true)
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $locked;

    /**
     * @ORM\Column(type="datetime", name="locked_at", nullable=true)
     */
    protected $lockedAt;

    /**
     * @Grid\Column(sortable=true,searchable=true)
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $priority;

    /**
     * @ORM\Column(type="string", name="crc_hash")
     */
    protected $crcHash;

    /**
     * @Grid\Column(sortable=true,order=2)
     * @ORM\Column(type="datetime", nullable=true, name="when_at")
     */
    protected $whenAt;

    /**
     * @Grid\Column(sortable=true)
     * @ORM\Column(type="datetime", nullable=true, name="expires_at")
     */
    protected $expiresAt;

    /**
     * When the job started.
     *
     * @Grid\Column(sortable=true)
     * @ORM\Column(type="datetime", nullable=true, name="started_at")
     */
    protected $startedAt;

    /**
     * When the job finished.
     *
     * @ORM\Column(type="datetime", nullable=true, name="finished_at")
     */
    protected $finishedAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $elapsed;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_duration")
     */
    protected $maxDuration;

    /**
     * @ORM\Column(type="bigint", nullable=true, name="run_id")
     */
    protected $runId;

    /**
     * @ORM\Column(type="integer", name="stalled_count")
     */
    protected $stalledCount = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_stalled")
     */
    protected $maxStalled;

    /**
     * @ORM\Column(type="integer", name="error_count")
     */
    protected $errorCount = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_error")
     */
    protected $maxError;

    /**
     * @ORM\Column(type="integer")
     */
    protected $retries = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_retries")
     */
    protected $maxRetries;

    /**
     * @return mixed
     */
    public function getRunId()
    {
        return $this->runId;
    }

    /**
     * @param mixed $runId
     */
    public function setRunId($runId)
    {
        $this->runId = $runId;
    }

    public function setArgs($args)
    {
        $args = serialize($args);
        parent::setArgs($args);
    }

    public function getArgs()
    {
        $args = parent::getArgs();

        return unserialize($args);
    }
}
