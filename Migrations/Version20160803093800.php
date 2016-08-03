<?php

namespace Ibtikar\ShareEconomyCMSBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160803093800 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page ADD titleAr VARCHAR(255) NOT NULL, ADD contentAr LONGTEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620CE671CFF ON page (titleAr)');

        $this->addSql("
            INSERT INTO `page` (`title`, `slug`, `content`, `created`, `updated`, `titleAr`, `contentAr`) VALUES
            ('About', 'about', NULL, '2016-08-03 09:40:03', '2016-08-03 09:40:03', 'عن الموقع', NULL),
            ('Privacy Policy', 'privacy-policy', NULL, '2016-08-03 09:40:03', '2016-08-03 09:40:03', 'سياسة الخصوصية', NULL),
            ('Terms and conditions', 'terms-and-conditions', NULL, '2016-08-03 09:40:03', '2016-08-03 09:40:03', 'الشروط و الأحكام', NULL);
        ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_140AB620CE671CFF ON page');
        $this->addSql('ALTER TABLE page DROP titleAr, DROP contentAr');
        $this->addSql("DELETE FROM page WHERE slug IN('about', 'privacy-policy', 'terms-and-conditions');");
    }
}
