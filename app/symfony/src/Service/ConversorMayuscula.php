<?php
namespace App\Service;

class ConversorMayuscula
{
    public function getMayuscula(string $texto): string
    {
       return strtoupper($texto);

    }
}