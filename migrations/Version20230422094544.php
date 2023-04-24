<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422094544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fruit_genus (id INT AUTO_INCREMENT NOT NULL, fruitfamily_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4FD22C5132894DE8 (fruitfamily_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fruit_order (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fruit_genus ADD CONSTRAINT FK_4FD22C5132894DE8 FOREIGN KEY (fruitfamily_id) REFERENCES fruit_family (id)');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD297863DC79D FOREIGN KEY (fruitgenus_id) REFERENCES fruit_genus (id)');
        $this->addSql('ALTER TABLE fruit_family ADD CONSTRAINT FK_13F71B5A528833DA FOREIGN KEY (fruit_order_id) REFERENCES fruit_order (id)');
        $this->addSql('ALTER TABLE nutrition ADD CONSTRAINT FK_B7C360F1BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fruit DROP FOREIGN KEY FK_A00BD297863DC79D');
        $this->addSql('ALTER TABLE fruit_family DROP FOREIGN KEY FK_13F71B5A528833DA');
        $this->addSql('ALTER TABLE fruit_genus DROP FOREIGN KEY FK_4FD22C5132894DE8');
        $this->addSql('DROP TABLE fruit_genus');
        $this->addSql('DROP TABLE fruit_order');
        $this->addSql('ALTER TABLE nutrition DROP FOREIGN KEY FK_B7C360F1BAC115F0');
    }
}
