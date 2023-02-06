<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202121527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation_flow_examens ADD parent_examen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation_flow_examens ADD CONSTRAINT FK_1255093EF4834A74 FOREIGN KEY (parent_examen_id) REFERENCES consultation_flow_examens (id)');
        $this->addSql('CREATE INDEX IDX_1255093EF4834A74 ON consultation_flow_examens (parent_examen_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation_flow_examens DROP FOREIGN KEY FK_1255093EF4834A74');
        $this->addSql('DROP INDEX IDX_1255093EF4834A74 ON consultation_flow_examens');
        $this->addSql('ALTER TABLE consultation_flow_examens DROP parent_examen_id');
    }
}
