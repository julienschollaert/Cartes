<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        //Génére et tri alétoirement le tableau de couleur
        $couleur = array('Coeur ♥️','Carreau ♦️','Trèfle ♣️','Pique ♠️');
        shuffle($couleur);

        //Génère et tri aléatoirement le tableau de valeur
        $valeur = array('As',2,3,4,5,6,7,8,9,10,'Valet','Dame','Roi');
        shuffle($valeur);

        $jeu = array();
        $jeuCouleur = array();
        $jeuValue = array();

        $i = 0;
        while($i>=0)
        {
            if(count(array_unique($jeu)) == 10)
            {
                break;
            }
            $val = array_rand($couleur, 1);
            $val1 = array_rand($valeur, 1);
            $jeu[] = $couleur[$val] . " " . $valeur[$val1];
            $jeuCouleur[] = $couleur[$val];
            $jeuValue[] = $valeur[$val1];
            $i++;
        }

        $jeuUnique = array_unique($jeu);
        $triCouleur = array_merge(array_flip($couleur), $jeuUnique);
        

    
        $tableauTrier = array();
        $tableauTrier1 = array();
        // $tabCoeur = array();
        // $tabTrefle = array();
        // $tabCarreau = array();
        // $tabPique = array();
        foreach($couleur as $row)
        {
            foreach ($jeuUnique as $row2)
            {
                $insert = strstr($row2, $row);
                if($insert == true )
                {
                    $tableauTrier[] = $row2;
                }
            }

            foreach($valeur as $row4)
            {   
               
                foreach($tableauTrier as $row3)
                {
                    $insert1 = strstr($row3, $row4);
                    if($insert1 == true )
                    {
                        $tableauTrier1[] = $row3;
                    }
                }
            }
            $tableauTrier = array();
        }

        // var_dump($tableauTrier1);
        // var_dump($jeuUnique);
        // var_dump($tableauTrier);

        return $this->render('home/index.html.twig', [
            'couleur' => $couleur,
            'valeur' => $valeur,
            'jeu' => $jeu,
            'jeuUnique' => $jeuUnique,
            'TriCouleur' => $tableauTrier,
            'TriCouleur1' => $tableauTrier1,
        ]);
    }
}
