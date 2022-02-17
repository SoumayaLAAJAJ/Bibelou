<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217085951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color_article (color_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_51AC83487ADA1FB5 (color_id), INDEX IDX_51AC83487294869C (article_id), PRIMARY KEY(color_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE color_article ADD CONSTRAINT FK_51AC83487ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE color_article ADD CONSTRAINT FK_51AC83487294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE color_article');
        $this->addSql('ALTER TABLE apropos CHANGE image_name image_name VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE article CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_name image_name VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE carousel CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE texte texte VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_name image_name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_name image_name VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE color CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE field field LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE size CHANGE name name VARCHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE firstname firstname VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
