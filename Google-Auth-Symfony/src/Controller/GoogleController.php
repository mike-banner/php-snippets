<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class GoogleController extends AbstractController
{

    #[route('connect/google', name: 'google_connect')]
    public function connect_auth(ClientRegistry $clientRegistry): RedirectResponse{
       return $clientRegistry->getClient('google')->redirect([], ['email', 'profile']);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return JsonRespponse|\symfony\component\HttpFoundation\RedirectResponse
     */
    #[route('oauth/check/google', name: 'google_check')]
    public function check_auth(Request $request, ClientRegistry $clientRegistry ){
      $client = $clientRegistry->getClient('google');
       if(!$this->getUser()){
        //dd($request);
            return new JsonResponse(array('status' => false, 'message' => "User n'existe pas"));
       } else {
         return $this->redirectToRoute('app_login');
      }
    // $code = ($_GET['id']);
    // $response = new Response($code);

    // //Retournez l'objet Response
    // return $response;
    // dd($request);
    }

    
}