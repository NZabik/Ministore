<?php

namespace App\Controller\Admin;

use App\Entity\Navbar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NavbarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Navbar::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('buttons'),
            TextField::new('route'),
            TextField::new('link'),
        ];
    }
    
}
