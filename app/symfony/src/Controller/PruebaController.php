<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Repository\NoticiaRepository;
use App\Service\ConversorTituloMayuscula;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PruebaController extends AbstractController
{

    public function __construct(private NoticiaRepository $noticiaRepository, private ConversorTituloMayuscula $conversorTituloMayuscula ){}


    /*public function listNoticias(): array {
        $result = [];
        $not = new Noticia();
        $not->setTitulo("titulo 1");
        $not->setDescripcion("descripción noticia 2");
        $date = new \DateTime("10/01/2022");
        $not->setImagen("https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg");
        $not->setFechaPublicacion($date);

        $not2 = new Noticia();
        $not2->setTitulo("titulo 2");
        $not2->setDescripcion("descripción noticia 2");
        $date = new \DateTime("20/05/2022");
        $not->setImagen("https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg");
        $not2->setFechaPublicacion($date);

        $result[] = $not;

        return $result;

    }*/



    public function __invoke( Request $request): JsonResponse
    {
        try {
            $noticias = $this->noticiaRepository->findAll();
            //$noticias = $this->listNoticias();                      // Línea de prueba
            $result = [];
            foreach ($noticias as $noticia) {
                $result[] = $this->conversorTituloMayuscula->getTituloMayuscula($noticia);

            }
            return new JsonResponse($result, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
