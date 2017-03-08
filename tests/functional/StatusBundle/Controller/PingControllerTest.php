<?php

namespace Markup\Test\StatusBundle\Controller;

use Markup\Test\StatusBundle\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Config\Loader\LoaderInterface;

class PingControllerTest extends WebTestCase
{
    protected static function createKernel(array $options = [])
    {
        return new class() extends TestKernel
        {
            public function registerContainerConfiguration(LoaderInterface $loader)
            {
                $loader->load(__DIR__.'/../fixtures/standard.yml');
            }

        };
    }

    public function testPing()
    {
        $client = static::createClient();
        $crawler = $client->request('HEAD', '/status/ping');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('pong', $response->headers->get('X-Status'));
        $this->assertEquals(69, $response->getTtl());
    }
}
