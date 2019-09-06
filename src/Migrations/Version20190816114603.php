<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816114603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE applications (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, jobs_id INT NOT NULL, date_application DATE NOT NULL, invitation TINYINT(1) DEFAULT NULL, INDEX IDX_F7C966F091BD8781 (candidate_id), INDEX IDX_F7C966F048704627 (jobs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jobs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, level_id INT NOT NULL, title VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, logo VARCHAR(250) NOT NULL, INDEX IDX_A8936DC5A76ED395 (user_id), INDEX IDX_A8936DC55FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F091BD8781 FOREIGN KEY (candidate_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE applications ADD CONSTRAINT FK_F7C966F048704627 FOREIGN KEY (jobs_id) REFERENCES jobs (id)');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC55FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(60) DEFAULT NULL, CHANGE dateofbirth dateofbirth DATE DEFAULT NULL, CHANGE file file VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applications DROP FOREIGN KEY FK_F7C966F048704627');
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE jobs');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE dateofbirth dateofbirth DATE DEFAULT \'NULL\', CHANGE file file VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
