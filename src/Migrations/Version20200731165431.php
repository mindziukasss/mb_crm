<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200731165431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE crm_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, original_file_name VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT DEFAULT NULL, attribute_alt VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_D625FE344E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crm_menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, position INT NOT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_12D91822989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crm_page (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, sub_menu_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_7BD69491CCD7E912 (menu_id), INDEX IDX_7BD69491B30FB5E6 (sub_menu_id), INDEX IDX_7BD694914E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crm_sub_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, title VARCHAR(64) NOT NULL, position INT NOT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_3414E8F9CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crm_gallery (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crm_media ADD CONSTRAINT FK_D625FE344E7AF8F FOREIGN KEY (gallery_id) REFERENCES crm_gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crm_page ADD CONSTRAINT FK_7BD69491CCD7E912 FOREIGN KEY (menu_id) REFERENCES crm_menu (id)');
        $this->addSql('ALTER TABLE crm_page ADD CONSTRAINT FK_7BD69491B30FB5E6 FOREIGN KEY (sub_menu_id) REFERENCES crm_sub_menu (id)');
        $this->addSql('ALTER TABLE crm_page ADD CONSTRAINT FK_7BD694914E7AF8F FOREIGN KEY (gallery_id) REFERENCES crm_gallery (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE crm_sub_menu ADD CONSTRAINT FK_3414E8F9CCD7E912 FOREIGN KEY (menu_id) REFERENCES crm_menu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crm_page DROP FOREIGN KEY FK_7BD69491CCD7E912');
        $this->addSql('ALTER TABLE crm_sub_menu DROP FOREIGN KEY FK_3414E8F9CCD7E912');
        $this->addSql('ALTER TABLE crm_page DROP FOREIGN KEY FK_7BD69491B30FB5E6');
        $this->addSql('ALTER TABLE crm_media DROP FOREIGN KEY FK_D625FE344E7AF8F');
        $this->addSql('ALTER TABLE crm_page DROP FOREIGN KEY FK_7BD694914E7AF8F');
        $this->addSql('DROP TABLE crm_media');
        $this->addSql('DROP TABLE crm_menu');
        $this->addSql('DROP TABLE crm_page');
        $this->addSql('DROP TABLE crm_sub_menu');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE crm_gallery');
    }
}
