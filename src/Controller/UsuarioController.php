<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="web_usuario_")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(): Response
    {
        return $this->render("usuario/form.html.twig");
    }

    /**
     * @Route("/salvar", methods={"POST"}, name="salvar")
     */
    public function salvar(Request $request,  ManagerRegistry $doctrine): Response
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
            return $this->render("usuario/sucesso.html.twig", [
                'fulano' => $data['nome']
            ]);
        } else {
            return $this->render("usuario/erro.html.twig", [
                'fulano' => $data['nome']
            ]);
        }
    }
}