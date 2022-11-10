<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('nom'),
            TextareaField::new('contenu')->hideOnForm(),
            TextEditorField::new('contenu')->onlyOnForms(),
            ChoiceField::new('categorie')->setChoices(['Sophrologie' => 'Sophrologie','Hypnose' => 'Hypnose', 'autre' => 'autre']),
            IntegerField::new('note'),
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
