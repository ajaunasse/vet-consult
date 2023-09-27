<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927123014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen_step ADD linked_consultation_flow_id INT DEFAULT NULL, ADD is_multi_focal TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE examen_step ADD CONSTRAINT FK_9CA21A255023EBB FOREIGN KEY (linked_consultation_flow_id) REFERENCES consultation_flow (id)');
        $this->addSql('CREATE INDEX IDX_9CA21A255023EBB ON examen_step (linked_consultation_flow_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen_step DROP FOREIGN KEY FK_9CA21A255023EBB');
        $this->addSql('DROP INDEX IDX_9CA21A255023EBB ON examen_step');
        $this->addSql('ALTER TABLE examen_step DROP linked_consultation_flow_id, DROP is_multi_focal');
    }
}
