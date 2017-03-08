<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Controller;

use Markup\StatusBundle\Repository\GroupRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is used as a simple ping/pong, for HEAD requests.
 *
 * Not really focusing on actually checking anything here just making sure we get a response back
 * which confirms that the Symfony container + PHP is at least running.
 */
class PingController extends Controller
{
    public function indexAction(): Response
    {
        $response = new Response(
            'pong', 200, [
                'X-Status' => 'pong',
            ]
        );

        /** @var GroupRepositoryInterface $groupRepository */
        $groupRepository = $this->get('markup_status.repository.group_repository');
        $group = $groupRepository->getByGroupName('ping');

        if ($group) {
            // Due to the nature of this test we are actually not interested in running this group only the options
            if ($group->hasOption('shared_max_age')) {
                $response->setSharedMaxAge($group->getOption('shared_max_age'));
            }
        }

        return $response;
    }
}
