<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129133936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijles ADD docent_id INT NOT NULL');
        $this->addSql('ALTER TABLE bijles ADD CONSTRAINT FK_A40C808957755C45 FOREIGN KEY (docent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A40C808957755C45 ON bijles (docent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijles DROP FOREIGN KEY FK_A40C808957755C45');
        $this->addSql('DROP INDEX IDX_A40C808957755C45 ON bijles');
        $this->addSql('ALTER TABLE bijles DROP docent_id');
    }
}
