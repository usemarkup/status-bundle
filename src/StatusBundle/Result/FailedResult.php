<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Result;

class FailedResult implements ResultInterface
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getCheckName(): string
    {
        return $this->name;
    }

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
    public function getContext()/*: ?ResultContextInterface php7.1*/
    {
        return null;
    }
}
