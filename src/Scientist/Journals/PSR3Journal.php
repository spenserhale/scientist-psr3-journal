<?php

namespace Scientist\Journals;

use Psr\Log\LoggerInterface;
use Scientist\Experiment;
use Scientist\Journal\Contracts\PSR3ConfigInterface;
use Scientist\Report;
use Scientist\Result;

/**
 * Class PSR3Journal
 *
 * @package \Scientist\Journals
 */
class PSR3Journal implements Journal
{
    /**
     * The executed experiment.
     *
     * @var \Scientist\Experiment
     */
    protected $experiment;

    /**
     * The experiment report.
     *
     * @var \Scientist\Report
     */
    protected $report;

    /**
     * PSR3 Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * PSR3 Config
     *
     * @var \Scientist\Journal\Contracts\PSR3ConfigInterface
     */
    protected $config;

    public function __construct(LoggerInterface $logger, PSR3ConfigInterface $config)
    {
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * Dispatch a report to storage.
     *
     * @param \Scientist\Experiment $experiment
     * @param \Scientist\Report $report
     * @return mixed
     */
    public function report(Experiment $experiment, Report $report)
    {
        $this->experiment = $experiment;
        $this->report = $report;

        $results = $report->getTrials();

        if (isset($results['control'])) {
            throw new \InvalidArgumentException('Cannot log trail with name of "control" since matches the control name.');
        }

        $results['control'] = $report->getControl();

        /** @var Result $result */
        foreach ($results as $key => $result) {
            $data_array = [
                $this->config->getIsMatchKey()     => $result->isMatch(),
                $this->config->getStartTimeKey()   => $result->getStartTime(),
                $this->config->getEndTimeKey()     => $result->getEndTime(),
                $this->config->getTimeKey()        => $result->getTime(),
                $this->config->getStartMemoryKey() => $result->getStartMemory(),
                $this->config->getEndMemoryKey()   => $result->getEndMemory(),
                $this->config->getMemoryKey()      => $result->getMemory(),
            ];

            if ($this->config->shouldReportValue()) {
                $data_array[$this->config->getValueKey()] = $this->config->formatValue($result->getValue());
            }

            $this->logger->{$this->config->getLevel()}($this->config->formatMessage($experiment, $report, $result,
                $key), $data_array);
        }

        return null;
    }

    /**
     * Get the experiment.
     *
     * @return \Scientist\Experiment
     */
    public function getExperiment(): Experiment
    {
        return $this->experiment;
    }

    /**
     * Get the experiment report.
     *
     * @return \Scientist\Report
     */
    public function getReport(): Report
    {
        return $this->report;
    }
}
