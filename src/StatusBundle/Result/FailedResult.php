<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Result;

class FailedResult implements ResultInterface
{
    /**
     * @inheritdoc
     */
    public function getResult(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getContext(): ?ResultContextInterface
    {
        return null;
    }
}
