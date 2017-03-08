<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Runner;

use Markup\StatusBundle\Collection\ResultCollection;
use Markup\StatusBundle\Group\Group;
use Markup\StatusBundle\Repository\CheckRepositoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Runner implements RunnerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CheckRepositoryInterface
     */
    private $checkRepository;

    /**
     * @param CheckRepositoryInterface $checkRepository
     * @param LoggerInterface|null $logger
     */
    public function __construct(CheckRepositoryInterface $checkRepository, LoggerInterface $logger = null)
    {
        $this->checkRepository = $checkRepository;
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * {@inheritdoc}
     */
    public function run(Group $group): ResultCollection
    {
        $resultCollection = new ResultCollection();

        if ($group === null) {
            return $resultCollection;
        }

        foreach ($group->getChecks() as $check) {
            $check = $this->checkRepository->getByCheckName($check);

            try {
                $result = $check->doCheck();

                $resultCollection->add($result);
            } catch (\Throwable $e) {
                $this->logger->critical(sprintf('Status check %s failed to complete its check.', $check->getName()), [
                    'check' => $check->getName(),
                    'description' => $check->getDescription()
                ]);
            }
        }

        return $resultCollection;
    }
}
