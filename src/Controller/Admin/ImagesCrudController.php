<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\DomCrawler\Field\FileFormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    public function getImageUrl(): ?string
    {
        if (!$this->images) {
            return null;
        }

        if (strpos($this->images, '/') !== false) {
            return $this->images;
        }

        return sprintf('uploads/images/%s', $this->images);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            // TextField::new('image'),
            AssociationField::new('article'),
            ImageField::new('image')->setBasePath('uploads/images')->setUploadDir('public/uploads/images')->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            ChoiceField::new('sliders')->setChoices(['cacher' => 0, 'afficher' => 1]),
            NumberField::new('ordre'),
        ];
    }
    
}
