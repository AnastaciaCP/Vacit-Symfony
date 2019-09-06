<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190819094842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applications CHANGE invitation invitation TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(60) DEFAULT NULL, CHANGE dateofbirth dateofbirth DATE DEFAULT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE postalcode postalcode VARCHAR(20) DEFAULT NULL, CHANGE city city VARCHAR(50) DEFAULT NULL, CHANGE biography biography LONGTEXT DEFAULT NULL, CHANGE file file VARCHAR(100) DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applications CHANGE invitation invitation TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE lastname lastname VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE dateofbirth dateofbirth DATE DEFAULT \'NULL\', CHANGE phonenumber phonenumber VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE address address VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE postalcode postalcode VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE city city VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE biography biography LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE file file VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
