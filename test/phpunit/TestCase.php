<?php

namespace Test;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{

    protected $useDatabase = false;
    protected $database;
    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';
        $this->database  = __DIR__.'/../../app/database/testing.sqlite';

        return require __DIR__.'/../../bootstrap/start.php';
    }

    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            return $this->call($method, $args[0]);
        }

        throw new BadMethodCallException;
    }

    /**
     * Default preparation for each test
     *
     */
    public function setUp()
    {
        parent::setUp(); // Don't forget this!

        $this->prepareForTests();
    }

    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     *
     */
    private function prepareForTests()
    {
        if ($this->useDatabase) {
            $this->setUpDb();
        }
        \Mail::pretend(true);
    }

    private function setUpDb()
    {
        $file = $this->database;
        `touch $file`;
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }

    public function tearDown()
    {
        parent::tearDown();
        // \Artisan::call('migrate:rollback');
        if ($this->useDatabase) {
            $file = $this->database;
            `rm $file`;
        }
    }
}
