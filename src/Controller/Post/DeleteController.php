<?php

namespace App\Controller\Post;

use App\Controller\TokenAuthenticatedController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DeleteController implements TokenAuthenticatedController
{
    public function index(Request $request)
    {
        return new Response('Hi world!');
    }
}
