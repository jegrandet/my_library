<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324184016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE collections (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE editeur_vf (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE editeur_vo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE serie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, titre_vo VARCHAR(255) NOT NULL, titre_traduit VARCHAR(255) DEFAULT NULL, nombre_tome_vo INTEGER DEFAULT NULL, nombre_tome_vf INTEGER NOT NULL, termine_vo BOOLEAN NOT NULL, termine_vf BOOLEAN NOT NULL, complete BOOLEAN NOT NULL, resume CLOB NOT NULL, image BLOB NOT NULL, source VARCHAR(1024) DEFAULT NULL)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE type_ouvrage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE collections');
        $this->addSql('DROP TABLE editeur_vf');
        $this->addSql('DROP TABLE editeur_vo');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_ouvrage');
    }
}
