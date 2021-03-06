<?php

namespace App\Controller;

use App\Service\DataParser;
use App\Service\RandomPicker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/submit", name="submit", methods={"POST"})
     */
    public function submit(Request $request, RandomPicker $randomPicker, DataParser $dataParser)
    {
        // Get the data from request
        $data = $request->request->all();

        // get the csrf token
        $submittedToken = $request->request->get('token');
                    
        // If csrftoken is valid
        if ($this->isCsrfTokenValid('form-token', $submittedToken)) {
            
            // Count array lenght to get maxIndex to pass to service dataParser
            $arrayLenght = count($data);
            $maxIndex = ($arrayLenght / 2) - 1;
    
            // On envoie les données vers le service parse Data
            $participantsArray = $dataParser->dataParse($data, $maxIndex);
    
            // On envoie les data parsed au service randomPicker
            $randomResults = $randomPicker->randomPicker($participantsArray, $maxIndex);
            // dump($randomResults);

            // Redirect to a view with the Data
            return $this->render('main/submit.html.twig', [
                'results' => $randomResults,
            ]);

        } else {

            $this->addFlash('notice', 'An error occured please try again');
            return $this->redirectToRoute('home');
        }

        
        
    }


}
