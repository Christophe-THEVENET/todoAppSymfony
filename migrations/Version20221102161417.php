<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102161417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '1ere migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list CHANGE color color VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY task_ibfk_1');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB253DAE168B FOREIGN KEY (list_id) REFERENCES list (id)');
        $this->addSql('ALTER TABLE task RENAME INDEX list_id TO IDX_527EDB253DAE168B');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list CHANGE color color VARCHAR(10) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB253DAE168B');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT task_ibfk_1 FOREIGN KEY (list_id) REFERENCES list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task RENAME INDEX idx_527edb253dae168b TO list_id');
    }
}
