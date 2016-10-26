<?php

namespace Ibtikar\ShareEconomyCMSBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161020123011 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact_type ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE cms_contact ADD updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD version INT DEFAULT 1 NOT NULL, CHANGE created_at created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE page ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, ADD version INT DEFAULT 1 NOT NULL, DROP created, DROP updated');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact DROP updated_at, DROP version, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cms_contact_type DROP created_at, DROP updated_at, DROP version');
        $this->addSql('ALTER TABLE page ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL, DROP created_at, DROP updated_at, DROP version');
    }
}
