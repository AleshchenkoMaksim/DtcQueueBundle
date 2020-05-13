<?php

namespace Dtc\QueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dtc\GridBundle\Annotation as Grid;

/**
 * @ORM\Entity
 * @ORM\Table(name="dtc_queue_run_archive")
 * @ORM\Table(name="dtc_queue_run_archive",indexes={
 *                  @ORM\Index(name="run_archive_ended_at_idx", columns={"ended_at"})})
 * @Grid\Grid(actions={@Grid\ShowAction()},sort=@Grid\Sort(column="endedAt",direction="DESC"))
 */
class RunArchive extends BaseRun
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $startedAt;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $duration; // How long to run for in seconds

    /**
     * @Grid\Column(sortable=true, order=2)
     * @ORM\Column(type="datetime", nullable=true, name="ended_at")
     */
    protected $endedAt;

    /**
     * @Grid\Column()
     * @ORM\Column(type="float", nullable=true)
     */
    protected $elapsed;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_count")
     */
    protected $maxCount;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="last_heartbeat_at")
     */
    protected $lastHeartbeatAt;

    /**
     * @ORM\Column(type="integer", nullable=true, name="process_timeout")
     */
    protected $processTimeout;

    /**
     * @ORM\Column(type="string", nullable=true, name="current_job_id")
     */
    protected $currentJobId;
}
