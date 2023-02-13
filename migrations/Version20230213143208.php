<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213143208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reseau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE techno_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE experience (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, society VARCHAR(255) NOT NULL, starting_date VARCHAR(255) NOT NULL, ending_date VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE experience_techno (experience_id INT NOT NULL, techno_id INT NOT NULL, PRIMARY KEY(experience_id, techno_id))');
        $this->addSql('CREATE INDEX IDX_CD3009F146E90E27 ON experience_techno (experience_id)');
        $this->addSql('CREATE INDEX IDX_CD3009F151F3C1BC ON experience_techno (techno_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, img VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project_techno (project_id INT NOT NULL, techno_id INT NOT NULL, PRIMARY KEY(project_id, techno_id))');
        $this->addSql('CREATE INDEX IDX_2E230596166D1F9C ON project_techno (project_id)');
        $this->addSql('CREATE INDEX IDX_2E23059651F3C1BC ON project_techno (techno_id)');
        $this->addSql('CREATE TABLE reseau (id INT NOT NULL, name VARCHAR(255) NOT NULL, url TEXT NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE techno (id INT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE experience_techno ADD CONSTRAINT FK_CD3009F146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience_techno ADD CONSTRAINT FK_CD3009F151F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E230596166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_techno ADD CONSTRAINT FK_2E23059651F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE experience_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reseau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE techno_id_seq CASCADE');
        $this->addSql('ALTER TABLE experience_techno DROP CONSTRAINT FK_CD3009F146E90E27');
        $this->addSql('ALTER TABLE experience_techno DROP CONSTRAINT FK_CD3009F151F3C1BC');
        $this->addSql('ALTER TABLE project_techno DROP CONSTRAINT FK_2E230596166D1F9C');
        $this->addSql('ALTER TABLE project_techno DROP CONSTRAINT FK_2E23059651F3C1BC');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_techno');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_techno');
        $this->addSql('DROP TABLE reseau');
        $this->addSql('DROP TABLE techno');
    }
}
