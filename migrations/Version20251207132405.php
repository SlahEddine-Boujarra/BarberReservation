<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251207132405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY `FK_FE38F84419EB6921`');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY `FK_FE38F8443E2E969B`');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY `FK_FE38F84464D218E`');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY `FK_FE38F844BFF2FEF2`');
        $this->addSql('ALTER TABLE appointment_service DROP FOREIGN KEY `FK_70BEA8FAE5B533F9`');
        $this->addSql('ALTER TABLE appointment_service DROP FOREIGN KEY `FK_70BEA8FAED5CA9E6`');
        $this->addSql('ALTER TABLE barber DROP FOREIGN KEY `FK_7C48A9A464D218E`');
        $this->addSql('ALTER TABLE barber DROP FOREIGN KEY `FK_7C48A9A4A76ED395`');
        $this->addSql('ALTER TABLE coin_transaction DROP FOREIGN KEY `FK_6B452399A76ED395`');
        $this->addSql('ALTER TABLE promotion_usage DROP FOREIGN KEY `FK_B0ED2A2D139DF194`');
        $this->addSql('ALTER TABLE promotion_usage DROP FOREIGN KEY `FK_B0ED2A2DA76ED395`');
        $this->addSql('ALTER TABLE promotion_usage DROP FOREIGN KEY `FK_B0ED2A2DE5B533F9`');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY `FK_794381C619EB6921`');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY `FK_794381C6BFF2FEF2`');
        $this->addSql('ALTER TABLE virtual_queue DROP FOREIGN KEY `FK_57164FE019EB6921`');
        $this->addSql('ALTER TABLE virtual_queue DROP FOREIGN KEY `FK_57164FE064D218E`');
        $this->addSql('ALTER TABLE virtual_queue DROP FOREIGN KEY `FK_57164FE0BFF2FEF2`');
        $this->addSql('ALTER TABLE working_hours DROP FOREIGN KEY `FK_D72CDC3D64D218E`');
        $this->addSql('ALTER TABLE working_hours DROP FOREIGN KEY `FK_D72CDC3DBFF2FEF2`');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_service');
        $this->addSql('DROP TABLE barber');
        $this->addSql('DROP TABLE coin_package');
        $this->addSql('DROP TABLE coin_transaction');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_usage');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE virtual_queue');
        $this->addSql('DROP TABLE working_hours');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY `FK_8D93D649758C8114`');
        $this->addSql('DROP INDEX IDX_8D93D649758C8114 ON user');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, DROP phone_number, DROP coin_balance, DROP referral_code, DROP is_verified, DROP referred_by_id, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, date DATETIME DEFAULT NULL, status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, total_price INT DEFAULT NULL, client_id INT DEFAULT NULL, barber_id INT NOT NULL, location_id INT NOT NULL, review_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_FE38F8443E2E969B (review_id), INDEX IDX_FE38F84419EB6921 (client_id), INDEX IDX_FE38F844BFF2FEF2 (barber_id), INDEX IDX_FE38F84464D218E (location_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE appointment_service (id INT AUTO_INCREMENT NOT NULL, price INT NOT NULL, appointment_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_70BEA8FAE5B533F9 (appointment_id), INDEX IDX_70BEA8FAED5CA9E6 (service_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE barber (id INT AUTO_INCREMENT NOT NULL, bio VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, commission_rate NUMERIC(5, 2) DEFAULT NULL, average_rating NUMERIC(3, 2) DEFAULT NULL, contract_status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, biography LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, experience_years INT DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, user_id INT DEFAULT NULL, location_id INT DEFAULT NULL, is_active TINYINT NOT NULL, INDEX IDX_7C48A9A464D218E (location_id), UNIQUE INDEX UNIQ_7C48A9A4A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coin_package (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, coin_amount INT DEFAULT NULL, price INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coin_transaction (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, amount INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, created_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_6B452399A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, postal_code VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, country VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, discount_percent INT DEFAULT NULL, expiration_date DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promotion_usage (id INT AUTO_INCREMENT NOT NULL, used_at DATETIME DEFAULT NULL, promotion_id INT DEFAULT NULL, user_id INT DEFAULT NULL, appointment_id INT DEFAULT NULL, INDEX IDX_B0ED2A2DA76ED395 (user_id), UNIQUE INDEX UNIQ_B0ED2A2DE5B533F9 (appointment_id), INDEX IDX_B0ED2A2D139DF194 (promotion_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, rating INT DEFAULT NULL, comment LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, created_at DATETIME DEFAULT NULL, barber_id INT NOT NULL, client_id INT DEFAULT NULL, INDEX IDX_794381C6BFF2FEF2 (barber_id), INDEX IDX_794381C619EB6921 (client_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, price INT DEFAULT NULL, duration INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE virtual_queue (id INT AUTO_INCREMENT NOT NULL, position INT DEFAULT NULL, status VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, estimated_wait INT DEFAULT NULL, client_id INT DEFAULT NULL, barber_id INT DEFAULT NULL, location_id INT DEFAULT NULL, INDEX IDX_57164FE019EB6921 (client_id), INDEX IDX_57164FE0BFF2FEF2 (barber_id), INDEX IDX_57164FE064D218E (location_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE working_hours (id INT AUTO_INCREMENT NOT NULL, day_of_week INT DEFAULT NULL, start_time TIME DEFAULT NULL, end_time TIME DEFAULT NULL, barber_id INT DEFAULT NULL, location_id INT DEFAULT NULL, INDEX IDX_D72CDC3DBFF2FEF2 (barber_id), INDEX IDX_D72CDC3D64D218E (location_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT `FK_FE38F84419EB6921` FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT `FK_FE38F8443E2E969B` FOREIGN KEY (review_id) REFERENCES review (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT `FK_FE38F84464D218E` FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT `FK_FE38F844BFF2FEF2` FOREIGN KEY (barber_id) REFERENCES barber (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment_service ADD CONSTRAINT `FK_70BEA8FAE5B533F9` FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment_service ADD CONSTRAINT `FK_70BEA8FAED5CA9E6` FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE barber ADD CONSTRAINT `FK_7C48A9A464D218E` FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE barber ADD CONSTRAINT `FK_7C48A9A4A76ED395` FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE coin_transaction ADD CONSTRAINT `FK_6B452399A76ED395` FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE promotion_usage ADD CONSTRAINT `FK_B0ED2A2D139DF194` FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE promotion_usage ADD CONSTRAINT `FK_B0ED2A2DA76ED395` FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE promotion_usage ADD CONSTRAINT `FK_B0ED2A2DE5B533F9` FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT `FK_794381C619EB6921` FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT `FK_794381C6BFF2FEF2` FOREIGN KEY (barber_id) REFERENCES barber (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE virtual_queue ADD CONSTRAINT `FK_57164FE019EB6921` FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE virtual_queue ADD CONSTRAINT `FK_57164FE064D218E` FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE virtual_queue ADD CONSTRAINT `FK_57164FE0BFF2FEF2` FOREIGN KEY (barber_id) REFERENCES barber (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE working_hours ADD CONSTRAINT `FK_D72CDC3D64D218E` FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE working_hours ADD CONSTRAINT `FK_D72CDC3DBFF2FEF2` FOREIGN KEY (barber_id) REFERENCES barber (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
        $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(20) NOT NULL, ADD coin_balance INT DEFAULT NULL, ADD referral_code VARCHAR(10) DEFAULT NULL, ADD is_verified TINYINT NOT NULL, ADD referred_by_id INT DEFAULT NULL, DROP phone, DROP created_at, CHANGE last_name last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT `FK_8D93D649758C8114` FOREIGN KEY (referred_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649758C8114 ON user (referred_by_id)');
    }
}
