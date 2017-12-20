<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Session bag voor de flash sessies. (package: laracasts/flash)
     * 
     * @var $flashSession
     */
    protected $flashSession = 'flash_notification.0';
}
