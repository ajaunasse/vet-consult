<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119104553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855B0E02586');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855B0E02586 FOREIGN KEY (expected_value_id) REFERENCES clinic_sign_value (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855B0E02586');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855B0E02586 FOREIGN KEY (expected_value_id) REFERENCES clinic_sign_type (id)');
    }
}
