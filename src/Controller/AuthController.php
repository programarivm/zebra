<?php

namespace App\Controller;

use App\Entity\User;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends AbstractController
{
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)
                    ->findOneBy([
                        'username' => $data->username,
                        'password' => $data->password
                    ]);

        if (!$user) {
            throw new NotFoundHttpException;
        }

        $token = [
            'sub' => $user->getId(),
            'exp' => time() + (60 * 60),
        ];

        return new Response(
            json_encode([
                'status' => Response::HTTP_OK,
                'access_token' => JWT::encode($token, getenv('JWT_SECRET'))
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
