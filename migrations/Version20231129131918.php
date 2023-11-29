<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129131918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijles ADD student_id INT NOT NULL, DROP student');
        $this->addSql('ALTER TABLE bijles ADD CONSTRAINT FK_A40C8089CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A40C8089CB944F1A ON bijles (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijles DROP FOREIGN KEY FK_A40C8089CB944F1A');
        $this->addSql('DROP INDEX IDX_A40C8089CB944F1A ON bijles');
        $this->addSql('ALTER TABLE bijles ADD student VARCHAR(255) NOT NULL, DROP student_id');
    }
}
