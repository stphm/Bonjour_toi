<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819213323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD description_id INT DEFAULT NULL, ADD physical_id INT DEFAULT NULL, ADD personnality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D9F966B FOREIGN KEY (description_id) REFERENCES description (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5A63AC0 FOREIGN KEY (physical_id) REFERENCES physical (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64934E7C3D2 FOREIGN KEY (personnality_id) REFERENCES personnality (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D9F966B ON user (description_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5A63AC0 ON user (physical_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64934E7C3D2 ON user (personnality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D9F966B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5A63AC0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64934E7C3D2');
        $this->addSql('DROP INDEX UNIQ_8D93D649D9F966B ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649F5A63AC0 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64934E7C3D2 ON user');
        $this->addSql('ALTER TABLE user DROP description_id, DROP physical_id, DROP personnality_id');
    }
}
