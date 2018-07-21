<?php

namespace Scientist\Journal;

use Psr\Log\LogLevel;
use Scientist\Experiment;
use Scientist\Report;
use Scientist\Result;

class PSR3JournalConfig implements Contracts\PSR3ConfigInterface
{
    public function getLevel(): string
    {
        return LogLevel::INFO;
    }

    public function shouldReportValue(): bool
    {
        return true;
    }

    public function getValueKey(): string
    {
        return 'value';
    }

    public function getIsMatchKey(): string
    {
        return 'is_match';
    }

    public function getStartTimeKey(): string
    {
        return 'start_time';
    }

    public function getEndTimeKey(): string
    {
        return 'end_time';
    }

    public function getTimeKey(): string
    {
        return 'time';
    }

    public function getStartMemoryKey(): string
    {
        return 'start_memory';
    }

    public function getEndMemoryKey(): string
    {
        return 'end_memory';
    }

    public function getMemoryKey(): string
    {
        return 'memory';
    }

    public function formatMessage(Experiment $experiment, Report $report, Result $result, string $result_key): string
    {
        return "{$report->getName()}: {$result_key}";
    }

    public function formatValue($value): string
    {
        return var_export($value, true);
    }
}