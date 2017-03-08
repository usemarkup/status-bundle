<?php

namespace Markup\Test\StatusBundle;

use Markup\StatusBundle\MarkupStatusBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Kernel;

abstract class TestKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function getCacheDir()
    {
        return __DIR__.'/../var/'.$this->getEnvironment().'/cache';
    }

    public function getLogDir()
    {
        return __DIR__.'/../var/'.$this->getEnvironment().'/logs';

    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new MarkupStatusBundle(),
        ];
    }
}
