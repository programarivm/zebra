<?php

namespace App\Controller\Post;

use App\Controller\AccessTokenController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DeleteController implements AccessTokenController
{
    public function index(Request $request)
    {
        return new Response('Hi world!');
    }
}
