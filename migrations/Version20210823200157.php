<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823200157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D64934E7C3D2, ADD INDEX IDX_8D93D64934E7C3D2 (personnality_id)');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649D9F966B, ADD INDEX IDX_8D93D649D9F966B (description_id)');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649F5A63AC0, ADD INDEX IDX_8D93D649F5A63AC0 (physical_id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D649D9F966B, ADD UNIQUE INDEX UNIQ_8D93D649D9F966B (description_id)');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D649F5A63AC0, ADD UNIQUE INDEX UNIQ_8D93D649F5A63AC0 (physical_id)');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D64934E7C3D2, ADD UNIQUE INDEX UNIQ_8D93D64934E7C3D2 (personnality_id)');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
