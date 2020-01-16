<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116125025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_type ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_type ADD CONSTRAINT FK_136758812469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_136758812469DE2 ON product_type (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_type DROP FOREIGN KEY FK_136758812469DE2');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP INDEX UNIQ_136758812469DE2 ON product_type');
        $this->addSql('ALTER TABLE product_type DROP category_id');
    }
}
