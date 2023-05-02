<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502085238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE injury DROP FOREIGN KEY FK_8A4A592DFF490375');
        $this->addSql('DROP INDEX IDX_8A4A592DFF490375 ON injury');
        $this->addSql('ALTER TABLE injury DROP consultation_reason_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE injury ADD consultation_reason_id INT NOT NULL');
        $this->addSql('ALTER TABLE injury ADD CONSTRAINT FK_8A4A592DFF490375 FOREIGN KEY (consultation_reason_id) REFERENCES consultation_reason (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8A4A592DFF490375 ON injury (consultation_reason_id)');
    }
}
