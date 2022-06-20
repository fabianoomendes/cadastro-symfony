<?php

namespace App\Controller\Api;

use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1", name="api_v1_usuario_")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/lista", methods={"GET"}, name="lista")
     */
    public function lista(ManagerRegistry $doctrine): JsonResponse
    {
        $doctrine = $doctrine->getRepository(Usuario::class);

        return new JsonResponse($doctrine->pegarTodos(), 200);
    }

    /**
     * @Route("/cadastra", methods={"POST"}, name="cadastra")
     */
    public function cadastra(Request $request,  ManagerRegistry $doctrine): Response
    {
        $data = $request->request->all();

        $usuario = new Usuario;
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);

        // dump($usuario);
        
        $doctrine = $doctrine->getManager();
        $doctrine->persist($usuario);
        $doctrine->flush();

        // dump($usuario);

        if ($doctrine->contains($usuario)) {
            return new Response("ok", 200);
        } else {
            return new Response("error", 404);
        }
    }
}