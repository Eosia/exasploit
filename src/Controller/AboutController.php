<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{

    private $repoCategorie;

    public function __construct(CategorieRepository $repoCategorie)
    {
        $this->repoCategorie = $repoCategorie;
    }



    /**
     * @Route("/about", name="about")
     */
    public function index(Request $request): Response
    {

        $categorie = $this->repoCategorie->find('slug');

        $categories = $this->repoCategorie->findAll();


        return $this->render('about/index.html.twig', [
            'categorie' => $categorie,
            'categories' => $categories
        ]);
    }



}
