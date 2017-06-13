<?php

namespace Vaniusa\ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Vaniusa\ProductsBundle\Entity\Products;
use Vaniusa\ProductsBundle\Form\ProductsType;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('VaniusaProductsBundle:Products')->findAll();
        return $this->render('VaniusaProductsBundle:Products:index.html.twig', array('products'=>$products));
    }

    public function mostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('VaniusaProductsBundle:Products')->find($id);
        return $this->render('VaniusaProductsBundle:Products:mostrar.html.twig', array('product'=>$product));
    }

    public function crearAction(Request $request)
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product, array('action'=>$this
            ->generateUrl('vaniusa_products_crear'), 'method'=>'POST'));

        $form->handleRequest($request);
        if ($form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($product);
              $em->flush();
              $this->get('session')->getFlashBag()->add('notif', 'Producto creado corectamente!');
              return $this->redirect($this->generateUrl('vaniusa_products_mostrar', array('id'=>$product->getId())));
        }
              $this->get('session')->getFlashBag()->add('notif', 'El producto no se ha creado corectamente!');
          return $this->render('VaniusaProductsBundle:Products:nuevo.html.twig', array('form'=>$form->createView()));
    }

    public function nuevoAction()
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product, array('action'=>$this
            ->generateUrl('vaniusa_products_crear'), 'method'=>'POST'));

        return $this->render('VaniusaProductsBundle:Products:nuevo.html.twig',
            array('form'=>$form->createView()));
    }

    public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('VaniusaProductsBundle:Products')->find($id);
        $form = $this->createForm(ProductsType::class, $product,
            array('action' => $this->generateUrl('vaniusa_products_actualizar', array('id' => $product->getId())),
            'method' => 'PUT'));
        $form->add('save', SubmitType::class, array('label' => 'Acrualizar Producto'));

        return $this->render('VaniusaProductsBundle:Products:editar.html.twig', array('form' => $form->createView()));
    }

    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('VaniusaProductsBundle:Products')->find($id);
        $form = $this->createForm(ProductsType::class, $product,
            array('action' => $this->generateUrl('vaniusa_products_actualizar', array('id' => $product->getId())),
            'method' => 'PUT'));
        $form->add('save', SubmitType::class, ['label' => 'Acrualizar Producto']);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('notif', 'Producto actualizado corectamente!');

            return $this->redirect($this->generateUrl('vaniusa_products_mostrar', array('id' => $product->getId())));
        }
        $this->get('session')->getFlashBag()->add('notif', 'Producto NO actualizado corectamente!');
        return $this->render('VaniusaProductsBundle:Products:nuevo.html.twig', array('form' => $form->createView()));
    }

    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('VaniusaProductsBundle:Products')->find($id);
        $em->remove($product);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notif', 'Producto eliminado correctamente!');
        return $this->redirect($this->generateUrl('vaniusa_products_homepage'));
    }
}


