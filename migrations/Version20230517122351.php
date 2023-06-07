<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517122351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation ADD injury_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6ABA45E9A FOREIGN KEY (injury_id) REFERENCES injury (id)');
        $this->addSql('CREATE INDEX IDX_964685A6A76ED395 ON consultation (user_id)');
        $this->addSql('CREATE INDEX IDX_964685A6ABA45E9A ON consultation (injury_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6A76ED395');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6ABA45E9A');
        $this->addSql('DROP INDEX IDX_964685A6A76ED395 ON consultation');
        $this->addSql('DROP INDEX IDX_964685A6ABA45E9A ON consultation');
        $this->addSql('ALTER TABLE consultation DROP injury_id');
    }
}
