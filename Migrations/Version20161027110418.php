<?php

namespace Ibtikar\ShareEconomyCMSBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161027110418 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact_type CHANGE title_ar title_ar VARCHAR(190) DEFAULT NULL, CHANGE title_en title_en VARCHAR(190) DEFAULT NULL');
        $this->addSql('ALTER TABLE cms_contact CHANGE title title VARCHAR(190) DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(190) NOT NULL, CHANGE slug slug VARCHAR(190) NOT NULL, CHANGE titleAr titleAr VARCHAR(190) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci');
        $this->addSql('ALTER TABLE cms_contact_type CHANGE title_ar title_ar VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci, CHANGE title_en title_en VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci, CHANGE titleAr titleAr VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci, CHANGE slug slug VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci');
    }
}
