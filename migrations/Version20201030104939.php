<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201030104939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birth_date DATETIME NOT NULL, death_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE borrowing (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, document_id INT NOT NULL, borrowed_at DATETIME NOT NULL, expected_return_date DATETIME NOT NULL, actual_return_date DATETIME DEFAULT NULL, INDEX IDX_226E5897A76ED395 (user_id), INDEX IDX_226E5897C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cd (id INT NOT NULL, total_duration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, reference_number VARCHAR(255) NOT NULL, stock INT NOT NULL, publisher VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_category (document_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_898DE898C33F7837 (document_id), INDEX IDX_898DE89812469DE2 (category_id), PRIMARY KEY(document_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_author (document_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_3CD69AEC33F7837 (document_id), INDEX IDX_3CD69AEF675F31B (author_id), PRIMARY KEY(document_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dvd (id INT NOT NULL, duration INT NOT NULL, has_bonus TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE novel (id INT NOT NULL, pages INT NOT NULL, original_language VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE penalty (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type ENUM(\'one_day\', \'seven_days\', \'fourteen_days\', \'blacklisted\'), amount DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_AFE28FD8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plage (id INT AUTO_INCREMENT NOT NULL, cd_id INT NOT NULL, title VARCHAR(255) NOT NULL, duration INT NOT NULL, INDEX IDX_107196C935F486F6 (cd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(200) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role JSON NOT NULL, subscribed_at DATETIME DEFAULT NULL, phone_number VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, subscription_end_date DATETIME DEFAULT NULL, status ENUM(\'free\', \'subscribed\'), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E5897C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE cd ADD CONSTRAINT FK_45D68FDABF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_category ADD CONSTRAINT FK_898DE898C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_category ADD CONSTRAINT FK_898DE89812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_author ADD CONSTRAINT FK_3CD69AEC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_author ADD CONSTRAINT FK_3CD69AEF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dvd ADD CONSTRAINT FK_8325C1DFBF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE novel ADD CONSTRAINT FK_8F977F17BF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE penalty ADD CONSTRAINT FK_AFE28FD8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plage ADD CONSTRAINT FK_107196C935F486F6 FOREIGN KEY (cd_id) REFERENCES cd (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_author DROP FOREIGN KEY FK_3CD69AEF675F31B');
        $this->addSql('ALTER TABLE document_category DROP FOREIGN KEY FK_898DE89812469DE2');
        $this->addSql('ALTER TABLE plage DROP FOREIGN KEY FK_107196C935F486F6');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897C33F7837');
        $this->addSql('ALTER TABLE cd DROP FOREIGN KEY FK_45D68FDABF396750');
        $this->addSql('ALTER TABLE document_category DROP FOREIGN KEY FK_898DE898C33F7837');
        $this->addSql('ALTER TABLE document_author DROP FOREIGN KEY FK_3CD69AEC33F7837');
        $this->addSql('ALTER TABLE dvd DROP FOREIGN KEY FK_8325C1DFBF396750');
        $this->addSql('ALTER TABLE novel DROP FOREIGN KEY FK_8F977F17BF396750');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E5897A76ED395');
        $this->addSql('ALTER TABLE penalty DROP FOREIGN KEY FK_AFE28FD8A76ED395');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE borrowing');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE cd');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_category');
        $this->addSql('DROP TABLE document_author');
        $this->addSql('DROP TABLE dvd');
        $this->addSql('DROP TABLE novel');
        $this->addSql('DROP TABLE penalty');
        $this->addSql('DROP TABLE plage');
        $this->addSql('DROP TABLE user');
    }
}
