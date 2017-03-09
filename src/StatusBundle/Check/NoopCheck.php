<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Check;

use Markup\StatusBundle\Result\ResultInterface;
use Markup\StatusBundle\Result\SuccessfulResult;

class NoopCheck implements CheckInterface
{
    /**
     * {@inheritdoc}
     */
    public function doCheck(): ResultInterface
    {
        return new SuccessfulResult($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'noop.check';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return 'No operation check';
    }
}
