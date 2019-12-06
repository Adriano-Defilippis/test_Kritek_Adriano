<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205225934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rows_invoice (id INT AUTO_INCREMENT NOT NULL, invoice_id_id INT NOT NULL, description LONGTEXT DEFAULT NULL, quantity INT NOT NULL, amount NUMERIC(12, 2) NOT NULL, iva_amount NUMERIC(12, 2) NOT NULL, total_amount NUMERIC(12, 2) NOT NULL, UNIQUE INDEX UNIQ_2C3CF35B429ECEE2 (invoice_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, number INT DEFAULT NULL, customer_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rows_invoice ADD CONSTRAINT FK_2C3CF35B429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rows_invoice DROP FOREIGN KEY FK_2C3CF35B429ECEE2');
        $this->addSql('DROP TABLE rows_invoice');
        $this->addSql('DROP TABLE invoice');
    }
}
