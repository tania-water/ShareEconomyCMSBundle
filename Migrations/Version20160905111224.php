<?php

namespace Ibtikar\ShareEconomyCMSBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160905111224 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cms_contact (id INT AUTO_INCREMENT NOT NULL, type_id SMALLINT NOT NULL, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, description TEXT DEFAULT NULL COLLATE utf8_unicode_ci, created_at DATETIME DEFAULT NULL, INDEX type_id (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms_contact_type (id SMALLINT AUTO_INCREMENT NOT NULL, title_ar VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, title_en VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cms_contact ADD CONSTRAINT cms_contact_ibfk_1 FOREIGN KEY (type_id) REFERENCES cms_contact_type (id) ON DELETE CASCADE');

        $contactTypes = <<<EOF
            INSERT INTO `cms_contact_type` (`id`, `title_ar`, `title_en`) VALUES
                (1, 'فكرة جديدة', 'New Idea'),
                (2, 'شكوى', 'Complain'),
                (3, 'إقتراح', 'Suggestion'),
                (4, 'أخرى', 'Other');
EOF;

        $this->addSql($contactTypes);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact DROP FOREIGN KEY cms_contact_ibfk_1');
        $this->addSql('DROP TABLE cms_contact');
        $this->addSql('DROP TABLE cms_contact_type');
    }
}
