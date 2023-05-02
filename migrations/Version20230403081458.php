<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403081458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clinic_examen (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, sub_title VARCHAR(255) NOT NULL, INDEX IDX_EE156A53C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_examen_clinic_sign_value (clinic_examen_id INT NOT NULL, clinic_sign_value_id INT NOT NULL, INDEX IDX_7DF16F8CFA7432F1 (clinic_examen_id), INDEX IDX_7DF16F8CDA3F1B4B (clinic_sign_value_id), PRIMARY KEY(clinic_examen_id, clinic_sign_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_sign_type (id INT AUTO_INCREMENT NOT NULL, main_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7409CB2B3107257A (main_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_sign_value (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, reasons_id INT NOT NULL, current_step_id INT DEFAULT NULL, consultation_flow_id INT NOT NULL, symptoms JSON DEFAULT NULL, INDEX IDX_964685A6F929F458 (reasons_id), INDEX IDX_964685A6D9BF9B19 (current_step_id), INDEX IDX_964685A63BB5FCF9 (consultation_flow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_examen_step (consultation_id INT NOT NULL, examen_step_id INT NOT NULL, INDEX IDX_79496CAD62FF6CDF (consultation_id), INDEX IDX_79496CADD03279B8 (examen_step_id), PRIMARY KEY(consultation_id, examen_step_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_flow (id INT AUTO_INCREMENT NOT NULL, reason_id INT NOT NULL, UNIQUE INDEX UNIQ_790956BA59BB1592 (reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_reason (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_step (id INT AUTO_INCREMENT NOT NULL, consultation_flow_id INT NOT NULL, trigger_value_id INT DEFAULT NULL, position INT NOT NULL, INDEX IDX_9CA21A253BB5FCF9 (consultation_flow_id), INDEX IDX_9CA21A25A62173AD (trigger_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_step_clinic_examen (examen_step_id INT NOT NULL, clinic_examen_id INT NOT NULL, INDEX IDX_C11AB520D03279B8 (examen_step_id), INDEX IDX_C11AB520FA7432F1 (clinic_examen_id), PRIMARY KEY(examen_step_id, clinic_examen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE injury (id INT AUTO_INCREMENT NOT NULL, consultation_reason_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8A4A592DFF490375 (consultation_reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major_injury_clinic_sign (id INT AUTO_INCREMENT NOT NULL, examen_id INT NOT NULL, expected_value_id INT NOT NULL, injury_id INT NOT NULL, INDEX IDX_314A38555C8659A (examen_id), INDEX IDX_314A3855B0E02586 (expected_value_id), INDEX IDX_314A3855ABA45E9A (injury_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_examen_clinic (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clinic_examen ADD CONSTRAINT FK_EE156A53C54C8C93 FOREIGN KEY (type_id) REFERENCES clinic_sign_type (id)');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value ADD CONSTRAINT FK_7DF16F8CFA7432F1 FOREIGN KEY (clinic_examen_id) REFERENCES clinic_examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value ADD CONSTRAINT FK_7DF16F8CDA3F1B4B FOREIGN KEY (clinic_sign_value_id) REFERENCES clinic_sign_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic_sign_type ADD CONSTRAINT FK_7409CB2B3107257A FOREIGN KEY (main_type_id) REFERENCES clinic_sign_type (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6F929F458 FOREIGN KEY (reasons_id) REFERENCES consultation_reason (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6D9BF9B19 FOREIGN KEY (current_step_id) REFERENCES examen_step (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A63BB5FCF9 FOREIGN KEY (consultation_flow_id) REFERENCES consultation_flow (id)');
        $this->addSql('ALTER TABLE consultation_examen_step ADD CONSTRAINT FK_79496CAD62FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_examen_step ADD CONSTRAINT FK_79496CADD03279B8 FOREIGN KEY (examen_step_id) REFERENCES examen_step (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_flow ADD CONSTRAINT FK_790956BA59BB1592 FOREIGN KEY (reason_id) REFERENCES consultation_reason (id)');
        $this->addSql('ALTER TABLE examen_step ADD CONSTRAINT FK_9CA21A253BB5FCF9 FOREIGN KEY (consultation_flow_id) REFERENCES consultation_flow (id)');
        $this->addSql('ALTER TABLE examen_step ADD CONSTRAINT FK_9CA21A25A62173AD FOREIGN KEY (trigger_value_id) REFERENCES clinic_sign_value (id)');
        $this->addSql('ALTER TABLE examen_step_clinic_examen ADD CONSTRAINT FK_C11AB520D03279B8 FOREIGN KEY (examen_step_id) REFERENCES examen_step (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE examen_step_clinic_examen ADD CONSTRAINT FK_C11AB520FA7432F1 FOREIGN KEY (clinic_examen_id) REFERENCES clinic_examen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE injury ADD CONSTRAINT FK_8A4A592DFF490375 FOREIGN KEY (consultation_reason_id) REFERENCES consultation_reason (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A38555C8659A FOREIGN KEY (examen_id) REFERENCES clinic_examen (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855B0E02586 FOREIGN KEY (expected_value_id) REFERENCES clinic_sign_value (id)');
        $this->addSql('ALTER TABLE major_injury_clinic_sign ADD CONSTRAINT FK_314A3855ABA45E9A FOREIGN KEY (injury_id) REFERENCES injury (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clinic_examen DROP FOREIGN KEY FK_EE156A53C54C8C93');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value DROP FOREIGN KEY FK_7DF16F8CFA7432F1');
        $this->addSql('ALTER TABLE clinic_examen_clinic_sign_value DROP FOREIGN KEY FK_7DF16F8CDA3F1B4B');
        $this->addSql('ALTER TABLE clinic_sign_type DROP FOREIGN KEY FK_7409CB2B3107257A');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6F929F458');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6D9BF9B19');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A63BB5FCF9');
        $this->addSql('ALTER TABLE consultation_examen_step DROP FOREIGN KEY FK_79496CAD62FF6CDF');
        $this->addSql('ALTER TABLE consultation_examen_step DROP FOREIGN KEY FK_79496CADD03279B8');
        $this->addSql('ALTER TABLE consultation_flow DROP FOREIGN KEY FK_790956BA59BB1592');
        $this->addSql('ALTER TABLE examen_step DROP FOREIGN KEY FK_9CA21A253BB5FCF9');
        $this->addSql('ALTER TABLE examen_step DROP FOREIGN KEY FK_9CA21A25A62173AD');
        $this->addSql('ALTER TABLE examen_step_clinic_examen DROP FOREIGN KEY FK_C11AB520D03279B8');
        $this->addSql('ALTER TABLE examen_step_clinic_examen DROP FOREIGN KEY FK_C11AB520FA7432F1');
        $this->addSql('ALTER TABLE injury DROP FOREIGN KEY FK_8A4A592DFF490375');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A38555C8659A');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855B0E02586');
        $this->addSql('ALTER TABLE major_injury_clinic_sign DROP FOREIGN KEY FK_314A3855ABA45E9A');
        $this->addSql('DROP TABLE clinic_examen');
        $this->addSql('DROP TABLE clinic_examen_clinic_sign_value');
        $this->addSql('DROP TABLE clinic_sign_type');
        $this->addSql('DROP TABLE clinic_sign_value');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE consultation_examen_step');
        $this->addSql('DROP TABLE consultation_flow');
        $this->addSql('DROP TABLE consultation_reason');
        $this->addSql('DROP TABLE examen_step');
        $this->addSql('DROP TABLE examen_step_clinic_examen');
        $this->addSql('DROP TABLE injury');
        $this->addSql('DROP TABLE major_injury_clinic_sign');
        $this->addSql('DROP TABLE sub_examen_clinic');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
