<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Result;

interface ResultInterface
{
    /**
     * @return bool
     */
    public function getResult(): bool;

    /**
     * @return ResultContextInterface|null
     */
    public function getContext()/*: ?ResultContextInterface php7.1 */;

    /**
     * @return string
     */
    public function getCheckName(): string;
}
