<?php

namespace AtomeDev\FacturationProApi\Tests;

use AtomeDev\FacturationProApi\Facades\FacturationProApi;
use AtomeDev\FacturationProApi\FacturationProApiServiceProvider;
use Orchestra\Testbench\TestCase;


class ExampleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [FacturationProApiServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }


    /** @test */
    public function config_is_set()
   {
        $this->assertNotEmpty(config('facturation-pro-api.url'));
    }

    /** @test */
    public function can_access_to_controller()
    {
        $Api = new FacturationProApi;
        $this->assertInstanceOf(FacturationProApi::class, $Api);
    }

    /** @test */
    public function it_can_call_info_api()
    {
        //$Api = new FacturationProApi;
        $infoApi = FacturationProApi::getApi('account', 'infos');
        $ret = FacturationProApi::callApi($infoApi);
        $this->assertTrue($ret['success']);
    }




}
