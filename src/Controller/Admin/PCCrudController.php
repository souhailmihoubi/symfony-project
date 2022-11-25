<?php

namespace App\Controller\Admin;

use App\Entity\PC;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PCCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PC::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield AssociationField::new('CodP','Produit'),
            yield AssociationField::new('NumC','Client'),
            yield Field::new('QteC','Quantité'),

        ];
    }
    
/*     public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('NumC'),
            ChoiceField::new('CodP'),
            NumberField::new('QteC'),
        ];
    }
     */
}
