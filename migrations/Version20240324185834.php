<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324185834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE serie_serie (serie_source INTEGER NOT NULL, serie_target INTEGER NOT NULL, PRIMARY KEY(serie_source, serie_target), CONSTRAINT FK_6236A7A0A820241A FOREIGN KEY (serie_source) REFERENCES serie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6236A7A0B1C57495 FOREIGN KEY (serie_target) REFERENCES serie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6236A7A0A820241A ON serie_serie (serie_source)');
        $this->addSql('CREATE INDEX IDX_6236A7A0B1C57495 ON serie_serie (serie_target)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE serie_serie');
    }
}
