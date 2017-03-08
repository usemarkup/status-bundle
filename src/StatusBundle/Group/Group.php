<?php declare(strict_types = 1);

namespace Markup\StatusBundle\Group;

class Group
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $checks;

    /**
     * @var array
     */
    private $options;

    /**
     * @param string $name
     * @param array $checks
     * @param array $options
     */
    public function __construct(string $name, array $checks = [], array $options = [])
    {
        $this->name = $name;
        $this->checks = $checks;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getChecks(): array
    {
        return $this->checks;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $option
     * @return bool
     */
    public function hasOption(string $option): bool
    {
        return isset($this->options[$option]);
    }

    /**
     * @param string $option
     * @return mixed
     */
    public function getOption(string $option)
    {
        return $this->options[$option];
    }
}
