<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426155942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_token (id INT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7BA2F5EBA76ED395 ON api_token (user_id)');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE manufacturer (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, country_code VARCHAR(3) NOT NULL, listed_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE manufacturer_country (manufacturer_id INT NOT NULL, country_id INT NOT NULL, PRIMARY KEY(manufacturer_id, country_id))');
        $this->addSql('CREATE INDEX IDX_EED38734A23B42D ON manufacturer_country (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_EED38734F92F3E70 ON manufacturer_country (country_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, manufacturer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, brochure_filename VARCHAR(255) NOT NULL, issue_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04ADA23B42D ON product (manufacturer_id)');
        $this->addSql('CREATE TABLE test (id INT NOT NULL, test VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manufacturer_country ADD CONSTRAINT FK_EED38734A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manufacturer_country ADD CONSTRAINT FK_EED38734F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE api_token DROP CONSTRAINT FK_7BA2F5EBA76ED395');
        $this->addSql('ALTER TABLE manufacturer_country DROP CONSTRAINT FK_EED38734A23B42D');
        $this->addSql('ALTER TABLE manufacturer_country DROP CONSTRAINT FK_EED38734F92F3E70');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADA23B42D');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE manufacturer_country');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE "user"');
    }
}
