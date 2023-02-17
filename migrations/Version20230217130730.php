<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217130730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE techno_cat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE techno_cat (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE techno ADD techno_cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE techno ADD CONSTRAINT FK_3987EEDCD15686AA FOREIGN KEY (techno_cat_id) REFERENCES techno_cat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3987EEDCD15686AA ON techno (techno_cat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE techno DROP CONSTRAINT FK_3987EEDCD15686AA');
        $this->addSql('DROP SEQUENCE techno_cat_id_seq CASCADE');
        $this->addSql('DROP TABLE techno_cat');
        $this->addSql('DROP INDEX IDX_3987EEDCD15686AA');
        $this->addSql('ALTER TABLE techno DROP techno_cat_id');
    }
}
