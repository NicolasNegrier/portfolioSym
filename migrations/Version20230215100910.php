<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215100910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience_techno DROP CONSTRAINT fk_cd3009f146e90e27');
        $this->addSql('ALTER TABLE experience_techno DROP CONSTRAINT fk_cd3009f151f3c1bc');
        $this->addSql('DROP TABLE experience_techno');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE experience_techno (experience_id INT NOT NULL, techno_id INT NOT NULL, PRIMARY KEY(experience_id, techno_id))');
        $this->addSql('CREATE INDEX idx_cd3009f151f3c1bc ON experience_techno (techno_id)');
        $this->addSql('CREATE INDEX idx_cd3009f146e90e27 ON experience_techno (experience_id)');
        $this->addSql('ALTER TABLE experience_techno ADD CONSTRAINT fk_cd3009f146e90e27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience_techno ADD CONSTRAINT fk_cd3009f151f3c1bc FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
