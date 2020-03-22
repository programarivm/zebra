<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PostController
{
    public function show(Request $request)
    {
        return new Response('Hi world!');
    }

    public function edit(Request $request)
    {
        return new Response('Hi world!');
    }
}
