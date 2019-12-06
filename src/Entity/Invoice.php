<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     */
    private $customer_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RowsInvoice", mappedBy="invoice_id", cascade={"persist", "remove"})
     */
    private $rowsInvoice;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getRowsInvoice(): ?RowsInvoice
    {
        return $this->rowsInvoice;
    }

    public function setRowsInvoice(RowsInvoice $rowsInvoice): self
    {
        $this->rowsInvoice = $rowsInvoice;

        // set the owning side of the relation if necessary
        if ($rowsInvoice->getInvoiceId() !== $this) {
            $rowsInvoice->setInvoiceId($this);
        }

        return $this;
    }

    public function __toString() {
      return $this->getDate();
    }
}
