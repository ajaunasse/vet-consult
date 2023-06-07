<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529090019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen_step ADD trigger_examen_id INT DEFAULT NULL, DROP triggers');
        $this->addSql('ALTER TABLE examen_step ADD CONSTRAINT FK_9CA21A25952879C3 FOREIGN KEY (trigger_examen_id) REFERENCES clinic_examen (id)');
        $this->addSql('CREATE INDEX IDX_9CA21A25952879C3 ON examen_step (trigger_examen_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen_step DROP FOREIGN KEY FK_9CA21A25952879C3');
        $this->addSql('DROP INDEX IDX_9CA21A25952879C3 ON examen_step');
        $this->addSql('ALTER TABLE examen_step ADD triggers JSON DEFAULT NULL, DROP trigger_examen_id');
    }
}
