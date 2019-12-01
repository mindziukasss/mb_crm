<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191201143316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE crm_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, original_file_name VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT DEFAULT NULL, attribute_alt VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_D625FE344E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crm_gallery (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crm_media ADD CONSTRAINT FK_D625FE344E7AF8F FOREIGN KEY (gallery_id) REFERENCES crm_gallery (id)');
        $this->addSql('ALTER TABLE crm_page ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE crm_page ADD CONSTRAINT FK_7BD694914E7AF8F FOREIGN KEY (gallery_id) REFERENCES crm_gallery (id)');
        $this->addSql('CREATE INDEX IDX_7BD694914E7AF8F ON crm_page (gallery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crm_media DROP FOREIGN KEY FK_D625FE344E7AF8F');
        $this->addSql('ALTER TABLE crm_page DROP FOREIGN KEY FK_7BD694914E7AF8F');
        $this->addSql('DROP TABLE crm_media');
        $this->addSql('DROP TABLE crm_gallery');
        $this->addSql('DROP INDEX IDX_7BD694914E7AF8F ON crm_page');
        $this->addSql('ALTER TABLE crm_page DROP gallery_id');
    }
}
