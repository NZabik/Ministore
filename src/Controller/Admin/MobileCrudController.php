<?php

namespace App\Controller\Admin;

use App\Entity\Mobile;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MobileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mobile::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('brand'),
            NumberField::new('price'),
            IntegerField::new('quantity'),
            ImageField::new('picture')
                ->setBasePath('images/')
                ->setUploadDir('public/images/')
                ->setRequired($pageName !== Crud::PAGE_EDIT)
                ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
        ];
    }

}
