<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251213233305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create reservation table and update barber table structure';
    }

    public function up(Schema $schema): void
    {
        // Create reservation table
        $this->addSql('CREATE TABLE reservation (
            id INT AUTO_INCREMENT NOT NULL,
            requested_time DATETIME NOT NULL,
            service VARCHAR(255) NOT NULL,
            status VARCHAR(50) NOT NULL,
            user_id INT NOT NULL,
            barber_id INT NOT NULL,
            INDEX IDX_42C84955A76ED395 (user_id),
            INDEX IDX_42C84955BFF2FEF2 (barber_id),
            PRIMARY KEY (id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci`');

        // Add foreign keys for reservation table
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id)');

        // Update barber table columns
        $this->addSql('ALTER TABLE barber 
            CHANGE name name VARCHAR(255) DEFAULT NULL,
            CHANGE email email VARCHAR(255) DEFAULT NULL,
            CHANGE phone phone VARCHAR(255) DEFAULT NULL,
            CHANGE location location VARCHAR(255) DEFAULT NULL,
            CHANGE user_id user_id INT NOT NULL');

        // Add foreign key for barber.user_id if needed
        $this->addSql('ALTER TABLE barber ADD CONSTRAINT FK_7C48A9A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7C48A9A4A76ED395 ON barber (user_id)');

        // Update user table coins column
        $this->addSql('ALTER TABLE user CHANGE coins coins INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Drop reservation table and its foreign keys
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY IF EXISTS FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY IF EXISTS FK_42C84955BFF2FEF2');
        $this->addSql('DROP TABLE IF EXISTS reservation');

        // Revert barber table changes (skip dropping non-existent FK safely)
        $this->addSql('ALTER TABLE barber 
            CHANGE name name VARCHAR(255) NOT NULL,
            CHANGE email email VARCHAR(255) NOT NULL,
            CHANGE phone phone VARCHAR(20) NOT NULL,
            CHANGE location location VARCHAR(255) NOT NULL,
            CHANGE user_id user_id INT DEFAULT NULL,
            ADD description VARCHAR(500) DEFAULT NULL');

        // Drop barber.user_id foreign key if exists
        $this->addSql('ALTER TABLE barber DROP FOREIGN KEY IF EXISTS FK_7C48A9A4A76ED395');
        $this->addSql('DROP INDEX IF EXISTS IDX_7C48A9A4A76ED395 ON barber');

        // Revert user table coins column
        $this->addSql('ALTER TABLE user CHANGE coins coins INT DEFAULT NULL');
    }
}
