<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

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
            TextField::new('titre'),
            TextareaField::new('description_courte')->hideOnForm(),
            TextEditorField::new('description_courte')->onlyOnForms(),
            TextareaField::new('description_longue')->hideOnForm(),
            TextEditorField::new('description_longue')->onlyOnForms(),
            ChoiceField::new('categorie')->setChoices(['Sophrologie' => 'Sophrologie','Hypnose' => 'Hypnose', 'autre' => 'autre']),
            NumberField::new('ordre'),
            ChoiceField::new('visible')->setChoices(['caché' => 0, 'visible' => 1]),
            AssociationField::new('images'),
            DateTimeField::new('dateCreation')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
        ];
    }
    
    public function createEntity(string $entityFqcn)
    {
        $pr = new $entityFqcn;
        $pr->setDateCreation(new \DateTime);
        return $pr;
    }
}
