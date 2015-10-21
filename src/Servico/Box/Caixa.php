<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Servico\Box;

/**
 * Description of Caixa
 *
 * @author administrador
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Caixa 
{
    //put your code here
    public function createService(Request $request)
    {
        $response = new Response('Service created',201);
        $response->headers->set('X-we-token', sha1(rand(1,10)));
        return $response;

    }
}
