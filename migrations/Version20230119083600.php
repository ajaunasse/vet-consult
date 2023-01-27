<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119083600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE injury (id INT AUTO_INCREMENT NOT NULL, consultation_reason_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8A4A592DFF490375 (consultation_reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE injury ADD CONSTRAINT FK_8A4A592DFF490375 FOREIGN KEY (consultation_reason_id) REFERENCES consultation_reason (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD injury_id INT NOT NULL');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855ABA45E9A FOREIGN KEY (injury_id) REFERENCES injury (id)');
        $this->addSql('CREATE INDEX IDX_314A3855ABA45E9A ON major_injury_clinic_sign (injury_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855ABA45E9A');
        $this->addSql('ALTER TABLE injury DROP FOREIGN KEY FK_8A4A592DFF490375');
        $this->addSql('DROP TABLE injury');
        $this->addSql('DROP INDEX IDX_314A3855ABA45E9A ON major_injury_clinic_sign');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP injury_id');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
