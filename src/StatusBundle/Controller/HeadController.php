<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Controller;

use Markup\StatusBundle\Repository\GroupRepositoryInterface;
use Markup\StatusBundle\Result\ResultInterface;
use Markup\StatusBundle\Runner\RunnerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is used for HEAD requests, so no content body is ever set.
 */
class HeadController extends Controller
{
    public function indexAction(string $group): Response
    {
        $response = new Response(
            '', Response::HTTP_OK, [
                'X-Status' => 'Ok',
            ]
        );

        /** @var GroupRepositoryInterface $groupRepository */
        $groupRepository = $this->get('markup_status.repository.group_repository');
        $group = $groupRepository->getByGroupName($group);

        if ($group === null) {
            return new Response('', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        /** @var RunnerInterface $runner */
        $runner = $this->get('markup_status.runner');
        $results = $runner->run($group);

        /** @var LoggerInterface $logger */
        $logger = new NullLogger();

        if ($this->has('logger')) {
            $logger = $this->get('logger');
        }

        /** @var ResultInterface $result */
        foreach ($results as $result) {
            if (!$result->getResult()) {
                $response->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE);
                $response->headers->set('X-Status', 'Service Unavailable', true);

                $logger->critical(
                    sprintf(
                        'Status group %s returned a failed status for %s check',
                        $group,
                        $result->getCheckName()
                    ),
                    [
                        'context' => $result->getContext(),
                    ]
                );
            }
        }

        if ($group->hasOption('shared_max_age')) {
            $response->setSharedMaxAge($group->getOption('shared_max_age'));
        }

        return $response;
    }
}
