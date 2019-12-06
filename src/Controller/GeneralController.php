<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\RowsInvoice;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Routing\Annotation\Route;

class GeneralController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $invoices = $this->getDoctrine()->getRepository(Invoice::class)->findAll();
        $rows_invoices = $this->getDoctrine()->getRepository(RowsInvoice::class)->findAll();

        return $this->render('general/index.html.twig', [
            'controller_name' => 'GeneralController',
            'invoices' => $invoices,
            'rows_invoices' => $rows_invoices
        ]);
    }

    /**
     * @Route("/show/{id}", name="showDetails")
     * Method ({"GET"})
     */

     public function show($id){

       $invoice = $this->getDoctrine()->getRepository(Invoice::class)->find($id);

       $details = $invoice->getRowsInvoice();
       // dd($invoice, $details);
       // dd($details);

       return $this->render('general/show_details.html.twig', [
           'controller_name' => 'GeneralController',
           'details' => $details,
           'invoice' => $invoice
       ]);
     }

    /**
     * @Route("/invoice/new", name="newInvoice")
     * Method ({"GET", "POST"})
     */
     public function new(Request $request){

       $invoice = new Invoice();
       $rows_invoice = new RowsInvoice();

       $form = $this->createFormBuilder()
         ->add('customer_id', NumberType::class, array(
           'required' => true,
           'attr'=> array('class'=> 'form-control')))
         ->add('description', TextareaType::class, array(
           'required' => false,
           'attr' => array('class' => 'form-control')
         ))
         ->add('quantity', NumberType::class, array(
           'required' => true,
           'attr'=> array('class'=> 'form-control')))
         ->add('amount', NumberType::class, array(
           'required' => true,
           'attr'=> array('class'=> 'form-control')))
         ->add('iva', NumberType::class, array(
           'required' => true,
           'attr'=> array('class'=> 'form-control')))
         ->add('save', SubmitType::class, array(
           'label'=> 'Create',
           'attr' => array('class' => 'btn btn-outline-primary form-control')
         ))
          ->getForm();

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {

            $validatedData = $form->getData();
            
            $amount = $validatedData['amount'] * $validatedData['quantity'];

            $iva = $amount *  $validatedData['iva'] / 100;

            $entityManager = $this->getDoctrine()->getManager();

            $invoice = new Invoice();

            $invoice->setDate(new \DateTime());
            $invoice->setNumber(rand(1000, 9999));
            $invoice->setCustomerId($validatedData['customer_id']);

            $entityManager->persist($invoice);

            $rows_invoice = new RowsInvoice;

            $rows_invoice->setInvoiceId($invoice);
            $rows_invoice->setDescription($validatedData['description']);
            $rows_invoice->setQuantity($validatedData['quantity']);
            $rows_invoice->setAmount($amount);
            $rows_invoice->setIvaAmount($iva);
            $rows_invoice->setTotalAmount($amount + $iva);


            $entityManager->persist($rows_invoice);
            //
            //
            $entityManager->flush();

            // dd($invoice, $rows_invoice);

            return $this->redirectToRoute('index');

          }

          return $this->render('create.html.twig', array(
            'form' => $form->createView()
          ));

     }

     /**
      * @Route("/delete/{id}", name="delete")
      * Method ({"GET", "POST"})
      */

      public function delete($id){

        $invoice = $this->getDoctrine()->getRepository(Invoice::class)->find($id);
        $details = $invoice->getRowsInvoice();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($invoice);
        $entityManager->remove($details);
        $entityManager->flush();

        return $this->redirectToRoute('index');
      }


}
