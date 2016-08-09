<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\AbstractBaseTest;

/**
 * Class BackendControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Controller
 * @author   David Romaní <david@flux.cat>
 */
class BackendControllerTest extends AbstractBaseTest
{
    /**
     * Test admin login request is successful
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', '/admin/login');

        $this->assertStatusCode(200, $client);
    }

    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideSuccessfulUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/screeners/supersector/list'),
            array('/admin/screeners/supersector/create'),
            array('/admin/screeners/supersector/1/delete'),
            array('/admin/screeners/supersector/1/edit'),
            array('/admin/screeners/sector/list'),
            array('/admin/screeners/sector/create'),
            array('/admin/screeners/sector/1/delete'),
            array('/admin/screeners/sector/1/edit'),
            array('/admin/screeners/stock/list'),
            array('/admin/screeners/stock/create'),
            array('/admin/screeners/stock/1/delete'),
            array('/admin/screeners/stock/1/edit'),
            array('/admin/screeners/screener/list'),
            array('/admin/screeners/screener/create'),
            array('/admin/screeners/screener/1/delete'),
        );
    }

    /**
     * Test HTTP request is not found
     *
     * @dataProvider provideNotFoundUrls
     * @param string $url
     */
    public function testAdminPagesAreNotFound($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Not found Urls provider
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/screeners/supersector/batch'),
            array('/admin/screeners/sector/batch'),
            array('/admin/screeners/stock/batch'),
            array('/admin/screeners/screener/batch'),
        );
    }
}
