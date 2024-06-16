<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324185316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE serie_type (serie_id INTEGER NOT NULL, type_id INTEGER NOT NULL, PRIMARY KEY(serie_id, type_id), CONSTRAINT FK_57BB431BD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_57BB431BC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_57BB431BD94388BD ON serie_type (serie_id)');
        $this->addSql('CREATE INDEX IDX_57BB431BC54C8C93 ON serie_type (type_id)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TEMPORARY TABLE __temp__livre AS SELECT id, titre, code_ean, date_publication, prix, possede, resume, image, source FROM livre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('CREATE TABLE livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, serie_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, code_ean VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, possede BOOLEAN DEFAULT NULL, resume CLOB NOT NULL, image BLOB DEFAULT NULL, source VARCHAR(1024) DEFAULT NULL, CONSTRAINT FK_AC634F99D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO livre (id, titre, code_ean, date_publication, prix, possede, resume, image, source) SELECT id, titre, code_ean, date_publication, prix, possede, resume, image, source FROM __temp__livre');
        $this->addSql('DROP TABLE __temp__livre');
        $this->addSql('CREATE INDEX IDX_AC634F99D94388BD ON livre (serie_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__serie AS SELECT id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source FROM serie');
        $this->addSql('DROP TABLE serie');
        $this->addSql('CREATE TABLE serie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, editeur_vo_id INTEGER DEFAULT NULL, editeur_vf_id INTEGER DEFAULT NULL, collection_id INTEGER DEFAULT NULL, type_ouvrage_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, titre_vo VARCHAR(255) NOT NULL, titre_traduit VARCHAR(255) DEFAULT NULL, nombre_tome_vo INTEGER DEFAULT NULL, nombre_tome_vf INTEGER NOT NULL, termine_vo BOOLEAN NOT NULL, termine_vf BOOLEAN NOT NULL, complete BOOLEAN NOT NULL, resume CLOB NOT NULL, image BLOB NOT NULL, source VARCHAR(1024) DEFAULT NULL, CONSTRAINT FK_AA3A93341B7B3BC0 FOREIGN KEY (editeur_vo_id) REFERENCES editeur_vo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AA3A93346673744A FOREIGN KEY (editeur_vf_id) REFERENCES editeur_vf (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AA3A9334514956FD FOREIGN KEY (collection_id) REFERENCES collections (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AA3A93348DB5290 FOREIGN KEY (type_ouvrage_id) REFERENCES type_ouvrage (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO serie (id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source) SELECT id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source FROM __temp__serie');
        $this->addSql('DROP TABLE __temp__serie');
        $this->addSql('CREATE INDEX IDX_AA3A93341B7B3BC0 ON serie (editeur_vo_id)');
        $this->addSql('CREATE INDEX IDX_AA3A93346673744A ON serie (editeur_vf_id)');
        $this->addSql('CREATE INDEX IDX_AA3A9334514956FD ON serie (collection_id)');
        $this->addSql('CREATE INDEX IDX_AA3A93348DB5290 ON serie (type_ouvrage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE serie_type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__livre AS SELECT id, titre, code_ean, date_publication, prix, possede, resume, image, source FROM livre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('CREATE TABLE livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, code_ean VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, possede BOOLEAN DEFAULT NULL, resume CLOB NOT NULL, image BLOB DEFAULT NULL, source VARCHAR(1024) DEFAULT NULL)');
        $this->addSql('INSERT INTO livre (id, titre, code_ean, date_publication, prix, possede, resume, image, source) SELECT id, titre, code_ean, date_publication, prix, possede, resume, image, source FROM __temp__livre');
        $this->addSql('DROP TABLE __temp__livre');
        $this->addSql('CREATE TEMPORARY TABLE __temp__serie AS SELECT id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source FROM serie');
        $this->addSql('DROP TABLE serie');
        $this->addSql('CREATE TABLE serie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, titre_vo VARCHAR(255) NOT NULL, titre_traduit VARCHAR(255) DEFAULT NULL, nombre_tome_vo INTEGER DEFAULT NULL, nombre_tome_vf INTEGER NOT NULL, termine_vo BOOLEAN NOT NULL, termine_vf BOOLEAN NOT NULL, complete BOOLEAN NOT NULL, resume CLOB NOT NULL, image BLOB NOT NULL, source VARCHAR(1024) DEFAULT NULL)');
        $this->addSql('INSERT INTO serie (id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source) SELECT id, titre, titre_vo, titre_traduit, nombre_tome_vo, nombre_tome_vf, termine_vo, termine_vf, complete, resume, image, source FROM __temp__serie');
        $this->addSql('DROP TABLE __temp__serie');
    }
}
