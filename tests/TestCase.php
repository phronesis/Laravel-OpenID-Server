<?php
namespace DavidUmoh\LaravelOpenID\Tests;

use DavidUmoh\LaravelOpenID\LaravelOpenIDServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase{

  /**
   * @ignore description
   *
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      LaravelOpenIDServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}
