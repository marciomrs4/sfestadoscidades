<?php

namespace Mrs\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MrsBlogBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function jsonAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        return $this->get('meu_servico')->createService($request);
        //$array = array('nome'=>'Marcio');
        //return new \Symfony\Component\HttpFoundation\JsonResponse($array);
    }
    
    public function jsonCidadesAction()
    {
    	$cidades = $this->getDoctrine()
    					->getManager()
    					->getRepository('Mrs\BlogBundle\Entity\Cidades')
    				    ->meuNovoMetodoAqui();
    	
		return $this->render('MrsBlogBundle:Default:jsoncidades.html.twig', array('cidades' => $cidades));
    	
    }
    
    public function serializerCidadesAction()
    {
    	$cidades = $this->getDoctrine()
    					->getManager()
				    	->getRepository('Mrs\BlogBundle\Entity\Cidades')
				    	->findAllInOrder();
    	 
    	$cidadesJson = $this->get('jms_serializer')
    						->serialize($cidades,'json');
    	 
    	return new Response($cidadesJson);
       
    }
    
}
