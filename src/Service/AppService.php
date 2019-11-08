<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Datasource\ModelAwareTrait;
use Cake\Log\LogTrait;
use Cake\ORM\Locator\LocatorAwareTrait;

abstract class AppService
{
    use LocatorAwareTrait;
    use LogTrait;
    use ModelAwareTrait;

    /**
     * @var bool|string|null
     */
    protected $name = null;
    /**
     * @var null
     */
    protected $plugin = null;

    /**
     * AppService constructor.
     * @param null $name Parameter object name
     */
    public function __construct($name = null)
    {
        if ($name !== null) {
            $this->name = $name;
        }

        if ($this->name === null) {
            [, $name] = namespaceSplit(static::class);
            $this->name = substr($name, 0, -10);
        }
        $this->initialize();
    }

    /**
     * Initialize
     * @return void
     */
    public function initialize()
    {
        // Implement me
    }

    /**
     * @param string $name Parameter object name
     * @return \Cake\Datasource\RepositoryInterface
     */
    public function __get($name)
    {
        return $this->loadModel($name);
    }
}
