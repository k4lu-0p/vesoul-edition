<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219130148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE command CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE birth birth DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE book CHANGE author_id author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD title VARCHAR(45) NOT NULL, ADD firstname VARCHAR(100) DEFAULT NULL, ADD lastname VARCHAR(100) DEFAULT NULL, CHANGE additional additional VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE book_id book_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address DROP title, DROP firstname, DROP lastname, CHANGE additional additional VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE book CHANGE author_id author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE book_id book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE birth birth DATE DEFAULT \'NULL\'');
    }
}
