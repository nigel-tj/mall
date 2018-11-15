<?php

namespace MigrateUsers;

/**
 * Class Logger
 * @package MigrateUsers
 */
class Logger
{
    const ERROR = 100;
    const SUCCESS = 200;
    const NOTICE = 300;
    const READY = 000;

    /**
     * @var array
     */
    protected $log = array();

    /**
     * Logger constructor.
     * @param MigrateUsers $migrateUsers
     */
    public function __construct(MigrateUsers $migrateUsers)
    {
        $this->migrateUsers = $migrateUsers;
        $this->log = get_transient(MigrateUsers::getKey() . '_log');

        if (empty($this->log)) {
            $this->log = array();
        }
    }

    /**
     *
     * @param $status
     * @return string
     */
    protected static function parseStatus($status)
    {
        switch ($status) {
            case static::ERROR:
                return __('Error');

            case static::SUCCESS:
                return __('Success');

            case static::NOTICE:
                return __('Notice');
            case static::READY:
            default:
                return __('Ready');
        }
    }

    /**
     *
     * @param $id
     * @return string
     */
    public function getStatus($id)
    {
        foreach ($this->log as $key => $value) {
            if ($key === $id && !empty($value['status'])) {
                return static::parseStatus($value['status']);
            }
        }

        return static::parseStatus(static::READY);
    }

    /**
     *
     * @param $id
     * @return array|null
     */
    public function getLog($id)
    {
        if (!$this->migrateUsers->getOption('logs')) {
            return null;
        }

        foreach ($this->log as $key => $value) {
            if ($key === $id && !empty($value['log'])) {
                return $value['log'];
            }
        }

        return null;
    }

    /**
     *
     * @param $id
     * @param $status
     * @param null $log
     */
    public function setStatus($id, $status, $log = null)
    {
        if (!$this->migrateUsers->getOption('logs')) {
            $log = null;
        }

        $this->log[$id] = ['status' => $status, 'log' => $log];

        set_transient(MigrateUsers::getKey() . '_log', $this->log, 60 * 60 * 24 * 7);
    }

    /**
     *
     */
    public function clear()
    {
        set_transient(MigrateUsers::getKey() . '_log', null);
    }
}