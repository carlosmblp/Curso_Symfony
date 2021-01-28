<?php  

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Request;




class IntegradorController extends AbstractFOSRestController
{
    /**
     * @Route("/clase4", name="clase4")
     */
    public function clase4(): Response
    {   


        $em = $this->getDoctrine()->getManager();

        $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
        return new JsonResponse(json_encode(serialize($usuarios)),200);
      
    }


    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {   

        return $this->render('integrador/formLogin.html.twig');
        
      
    }



    /**
     * @Route("/verificar", name="verificar", methods={"GET", "POST"})
     */
    public function verificar(Request $request): Response
    {   
        
        $email = $request->get('email');
        $password = $request->get('password');
        
        $em = $this->getDoctrine()->getManager();

        $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['email' => $email,
                                                                                    'password' => $password]);
        if($usuarios){
            $exito = true;
            $mensaje = "Bienvenido ".$email;
        }else{
            $exito = true;
            $mensaje = "Usuario no valido";
        }
        return $this->render('integrador/resultado.html.twig', [
            'exito' => $exito,
            'mensaje' => $mensaje,
        ]);
        
      
    }


   


}




?>