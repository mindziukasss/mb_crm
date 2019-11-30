<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130182150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crm_page DROP INDEX UNIQ_7BD69491B30FB5E6, ADD INDEX IDX_7BD69491B30FB5E6 (sub_menu_id)');
        $this->addSql('ALTER TABLE crm_page DROP INDEX UNIQ_7BD69491CCD7E912, ADD INDEX IDX_7BD69491CCD7E912 (menu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE crm_page DROP INDEX IDX_7BD69491CCD7E912, ADD UNIQUE INDEX UNIQ_7BD69491CCD7E912 (menu_id)');
        $this->addSql('ALTER TABLE crm_page DROP INDEX IDX_7BD69491B30FB5E6, ADD UNIQUE INDEX UNIQ_7BD69491B30FB5E6 (sub_menu_id)');
    }
}
