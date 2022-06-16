<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="web_usuario_")
 */
class UsuarioController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(): Response
    {
        return new Response("Implementar formulário de cadastro", 200);
    }

    /**
     * @Route("/salvar", methods={"POST"}, name="salvar")
     */
    public function salvar(): Response
    {
        return new Response("Imprementar gravação ao banco de dados", 200);
    }
}