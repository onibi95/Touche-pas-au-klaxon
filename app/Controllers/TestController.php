<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class TestController
{
    public function index()
    {
        return new Response('TEST CONTROLLER OK');
    }
}
