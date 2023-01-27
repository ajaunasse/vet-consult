<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119140551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation_flow (id INT AUTO_INCREMENT NOT NULL, reason_id INT NOT NULL, UNIQUE INDEX UNIQ_790956BA59BB1592 (reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_flow_examens (id INT AUTO_INCREMENT NOT NULL, consultation_flow_id INT NOT NULL, clinic_examen_id INT NOT NULL, position DOUBLE PRECISION NOT NULL, INDEX IDX_1255093E3BB5FCF9 (consultation_flow_id), INDEX IDX_1255093EFA7432F1 (clinic_examen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation_flow ADD CONSTRAINT FK_790956BA59BB1592 FOREIGN KEY (reason_id) REFERENCES consultation_reason (id)');
        $this->addSql('ALTER TABLE consultation_flow_examens ADD CONSTRAINT FK_1255093E3BB5FCF9 FOREIGN KEY (consultation_flow_id) REFERENCES consultation_flow (id)');
        $this->addSql('ALTER TABLE consultation_flow_examens ADD CONSTRAINT FK_1255093EFA7432F1 FOREIGN KEY (clinic_examen_id) REFERENCES clinic_examen (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation_flow DROP FOREIGN KEY FK_790956BA59BB1592');
        $this->addSql('ALTER TABLE consultation_flow_examens DROP FOREIGN KEY FK_1255093E3BB5FCF9');
        $this->addSql('ALTER TABLE consultation_flow_examens DROP FOREIGN KEY FK_1255093EFA7432F1');
        $this->addSql('DROP TABLE consultation_flow');
        $this->addSql('DROP TABLE consultation_flow_examens');
    }
}
