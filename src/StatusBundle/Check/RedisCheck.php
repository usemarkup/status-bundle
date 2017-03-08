<?php

namespace Markup\StatusBundle\Check;

use Markup\StatusBundle\Result\FailedResult;
use Markup\StatusBundle\Result\ResultInterface;
use Markup\StatusBundle\Result\SuccessfulResult;
use Predis\Client as Predis;
use Predis\Response\Status;

class RedisCheck implements CheckInterface
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @param string $dsn
     */
    public function __construct(string $dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * @inheritDoc
     */
    public function doCheck(): ResultInterface
    {
        $predis = new Predis($this->dsn);
        $command = $predis->createCommand('PING');

        try {
            $result = $predis->executeCommand($command);

            if ($result instanceof Status && $result->getPayload() === 'PONG') {
                return new SuccessfulResult();
            }
        } catch (\Throwable $e) {
        }

        return new FailedResult();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'redis.check';
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return 'Ensure redis is online and responding.';
    }
}
