<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902065732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, project_id INT DEFAULT NULL, creator_id INT NOT NULL, name VARCHAR(50) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB25166D1F9C ON task (project_id)');
        $this->addSql('CREATE INDEX IDX_527EDB2561220EA6 ON task (creator_id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2561220EA6 FOREIGN KEY (creator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0ee2b921607');
        $this->addSql('DROP INDEX idx_2fb3d0ee2b921607');
        $this->addSql('ALTER TABLE project RENAME COLUMN creater_id TO сreator_id');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE14E93D0B FOREIGN KEY (сreator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE14E93D0B ON project (сreator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25166D1F9C');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB2561220EA6');
        $this->addSql('DROP TABLE task');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE14E93D0B');
        $this->addSql('DROP INDEX IDX_2FB3D0EE14E93D0B');
        $this->addSql('ALTER TABLE project RENAME COLUMN сreator_id TO creater_id');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0ee2b921607 FOREIGN KEY (creater_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2fb3d0ee2b921607 ON project (creater_id)');
    }
}
