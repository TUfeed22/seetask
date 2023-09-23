<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230905182900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0ee14e93d0b');
        $this->addSql('DROP INDEX idx_2fb3d0ee14e93d0b');
        $this->addSql('ALTER TABLE project RENAME COLUMN сreator_id TO creator_id');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE61220EA6 FOREIGN KEY (creator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE61220EA6 ON project (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE61220EA6');
        $this->addSql('DROP INDEX IDX_2FB3D0EE61220EA6');
        $this->addSql('ALTER TABLE project RENAME COLUMN creator_id TO "сreator_id"');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0ee14e93d0b FOREIGN KEY ("сreator_id") REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2fb3d0ee14e93d0b ON project (сreator_id)');
    }
}
