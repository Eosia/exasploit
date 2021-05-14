<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    private $repoCategorie;

    public function __construct(CategorieRepository $repoCategorie)
    {
        $this->repoCategorie = $repoCategorie;
    }



    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {

        $categorie = $this->repoCategorie->find('slug');

        $categories = $this->repoCategorie->findAll();


        return $this->render('contact/index.html.twig', [
            'categorie' => $categorie,
            'categories' => $categories
        ]);
    }


}
