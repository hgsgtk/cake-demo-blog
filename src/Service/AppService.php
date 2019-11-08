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
     * @param null $name
     */
    public function __construct($name = null)
    {
        if ($name !== null) {
            $this->name = $name;
        }

        if ($this->name === null) {
            list(, $name) = namespaceSplit(get_class($this));
            $this->name = substr($name, 0, -10);
        }
        $this->initialize();
    }

    /**
     *
     */
    public function initialize()
    {
        // Implement me
    }

    /**
     * @param $name
     * @return \Cake\Datasource\RepositoryInterface
     */
    public function __get($name)
    {
        return $this->loadModel($name);
    }

}
