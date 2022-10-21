<?php
namespace App\Service;

use App\Entity\Noticia;

class ConversorTituloMayuscula
{
    public function getTituloMayuscula(Noticia $noticia): Noticia
    {

        $titulo = strtoupper($noticia->getTitulo());
        $noticia->setTitulo($titulo);

        return $noticia;
    }
}