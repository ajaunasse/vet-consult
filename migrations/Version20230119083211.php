<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119083211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clinic_examen (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, INDEX IDX_EE156A53C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_examen_clinic_sign_value (clinic_examen_id INT NOT NULL, clinic_sign_value_id INT NOT NULL, INDEX IDX_7DF16F8CFA7432F1 (clinic_examen_id), INDEX IDX_7DF16F8CDA3F1B4B (clinic_sign_value_id), PRIMARY KEY(clinic_examen_id, clinic_sign_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_sign_type (id INT AUTO_INCREMENT NOT NULL, main_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7409CB2B3107257A (main_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_sign_value (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_reason (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major_injury_clinic_sign (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, expected_value_id INT NOT NULL, INDEX IDX_314A3855C54C8C93 (type_id), INDEX IDX_314A3855B0E02586 (expected_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clinic_examen ADD CONSTRAINT FK_EE156A53C54C8C93 FOREIGN KEY (type_id) REFERENCES clinic_sign_type (id)');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value ADD CONSTRAINT FK_7DF16F8CFA7432F1 FOREIGN KEY (clinic_examen_id) REFERENCES clinic_examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value ADD CONSTRAINT FK_7DF16F8CDA3F1B4B FOREIGN KEY (clinic_sign_value_id) REFERENCES clinic_sign_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic_sign_type ADD CONSTRAINT FK_7409CB2B3107257A FOREIGN KEY (main_type_id) REFERENCES clinic_sign_type (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855C54C8C93 FOREIGN KEY (type_id) REFERENCES clinic_sign_type (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855B0E02586 FOREIGN KEY (expected_value_id) REFERENCES clinic_sign_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clinic_examen DROP FOREIGN KEY FK_EE156A53C54C8C93');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value DROP FOREIGN KEY FK_7DF16F8CFA7432F1');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value DROP FOREIGN KEY FK_7DF16F8CDA3F1B4B');
        $this->addSql('ALTER TABLE clinic_sign_type DROP FOREIGN KEY FK_7409CB2B3107257A');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855C54C8C93');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855B0E02586');
        $this->addSql('DROP TABLE clinic_examen');
        $this->addSql('DROP TABLE clinic_examen_clinic_sign_value');
        $this->addSql('DROP TABLE clinic_sign_type');
        $this->addSql('DROP TABLE clinic_sign_value');
        $this->addSql('DROP TABLE consultation_reason');
        $this->addSql('DROP TABLE major_injury_clinic_sign');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
