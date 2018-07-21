<?php

namespace Scientist\Journal\Contracts;

use Scientist\Experiment;
use Scientist\Report;
use Scientist\Result;

interface PSR3ConfigInterface
{
    /**
     * Get the default log level
     *
     * Must return one of these constants.
     * \Psr\Log\LogLevel::EMERGENCY
     * \Psr\Log\LogLevel::ALERT
     * \Psr\Log\LogLevel::CRITICAL
     * \Psr\Log\LogLevel::ERROR
     * \Psr\Log\LogLevel::WARNING
     * \Psr\Log\LogLevel::NOTICE
     * \Psr\Log\LogLevel::INFO
     * \Psr\Log\LogLevel::DEBUG
     *
     * @return string
     */
    public function getLevel(): string;

    /**
     * Return true if the we should report the value
     *
     * @return boolean
     */
    public function shouldReportValue(): bool;

    /**
     * Return the value key to be used
     *
     * @return string
     */
    public function getValueKey(): string;

    /**
     * Return the is match key to be used
     *
     * @return string
     */
    public function getIsMatchKey(): string;

    /**
     * Return the start time key to be used
     *
     * @return string
     */
    public function getStartTimeKey(): string;

    /**
     * Return the end time key to be used
     *
     * @return string
     */
    public function getEndTimeKey(): string;

    /**
     * Return the time key to be used
     *
     * @return string
     */
    public function getTimeKey(): string;

    /**
     * Return the start memory key to be used
     *
     * @return string
     */
    public function getStartMemoryKey(): string;

    /**
     * Return the end memory key to be used
     *
     * @return string
     */
    public function getEndMemoryKey(): string;

    /**
     * Return the memory key to be used
     *
     * @return string
     */
    public function getMemoryKey(): string;

    /**
     * Format the message to be used
     *
     * @param Experiment $experiment
     * @param Report $report
     * @param Result $result
     * @param string $result_key
     *
     * @return string
     */
    public function formatMessage(Experiment $experiment, Report $report, Result $result, string $result_key): string;

    /**
     * Format how the value will be presented
     *
     * @param mixed $value
     *
     * @return string
     */
    public function formatValue($value): string;
}