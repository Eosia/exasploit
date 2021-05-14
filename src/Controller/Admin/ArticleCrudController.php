<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre', 'Titre de l\'article'),
            AssociationField::new('categorie', 'Catégorie de thématique'),
            TextEditorField::new('contenu'),
            DateField::new('createdAt')->hideOnForm(),

            /*image*/
            ImageField::new('image', 'Image')->setUploadDir("public/assets/img")
                ->setBasePath("assets/img")
                ->setRequired(false),

            UrlField::new('video', 'Lien vidéo youtube (avec embed)'),

            SlugField::new('slug')->setTargetFieldName('titre')->hideOnForm(),

        ];
    }

}
