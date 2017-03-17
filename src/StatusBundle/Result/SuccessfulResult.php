<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Result;

class SuccessfulResult implements ResultInterface
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
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getContext()/*: ?ResultContextInterface php71*/
    {
        return null;
    }
}
