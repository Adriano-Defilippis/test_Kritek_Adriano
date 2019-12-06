<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205224524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rows_invoice CHANGE amount amount NUMERIC(12, 2) NOT NULL, CHANGE invoice_id invoice_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE rows_invoice ADD CONSTRAINT FK_2C3CF35B429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C3CF35B429ECEE2 ON rows_invoice (invoice_id_id)');
        $this->addSql('ALTER TABLE invoice CHANGE number number INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice CHANGE number number INT NOT NULL');
        $this->addSql('ALTER TABLE rows_invoice DROP FOREIGN KEY FK_2C3CF35B429ECEE2');
        $this->addSql('DROP INDEX UNIQ_2C3CF35B429ECEE2 ON rows_invoice');
        $this->addSql('ALTER TABLE rows_invoice CHANGE amount amount NUMERIC(14, 2) NOT NULL, CHANGE invoice_id_id invoice_id INT NOT NULL');
    }
}
