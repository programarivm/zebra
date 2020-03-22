<?php

namespace App\Controller\Post;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ShowController
{
    public function index(Request $request)
    {
        return new Response('Hi world!');
    }
}
