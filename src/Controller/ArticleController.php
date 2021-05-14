<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    private $repoArticle;
    private $repoCategorie;

    public function __construct(ArticleRepository $repoArticle, CategorieRepository $repoCategorie)
    {
        $this->repoArticle = $repoArticle;
        $this->repoCategorie = $repoCategorie;
    }


    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $categorie = $this->repoCategorie->find('slug');

        $categories = $this->repoCategorie->findAll();

        $articles = $this->repoArticle->findBy([], ['id' => 'desc']);

        /*pagination page articles*/
        $articles = $paginator->paginate(
            $articles, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'categorie' => $categorie,
            'categories' => $categories
        ]);

    }


    /**
     * @Route("/article/{slug}", name="show_article")
     */
    public function article_show(?Article $article, ArticleRepository $repoArticle): Response
    {

        if (!$article) {
            return $this->redirectToRoute('home');
        }

        $categorie = $article->getCategorie('slug');

        $categories = $this->repoCategorie->findAll();

        return $this->render('article/show_article.html.twig', [
            'article' => $article,
            'categorie' => $categorie,
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/categorie/{slug}", name="show_categorie")
     */
    public function categorie_show(?Categorie $categorie, CategorieRepository $repoCategorie, ArticleRepository $repoArticle): Response
    {

        //$articles = $this->repoArticle->findBy([], ['id' => 'desc']);


        if($categorie) {

            $articles = $categorie->getArticles()->getValues();

            //$articles = $this->repoArticle->findBy([], ['id' => 'desc']);

        }

        else {
            return $this->redirectToRoute('home');
        }


        $categories = $this->repoCategorie->findAll();

        return $this->render('article/show_categorie.html.twig',[
            'articles' => $articles,
            'categorie' => $categorie,
            'categories' => $categories
        ]);

    }



}
