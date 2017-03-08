<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Result;

class SuccessfulResult implements ResultInterface
{
    /**
     * @inheritdoc
     */
    public function getResult(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getContext(): ?ResultContextInterface
    {
        return null;
    }
}
