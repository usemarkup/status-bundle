<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Check;

use Markup\StatusBundle\Result\ResultInterface;

interface CheckInterface
{
    /**
     * @return ResultInterface
     */
    public function doCheck(): ResultInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;
}
