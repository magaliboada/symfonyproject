<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116125234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fabric (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, fabric_id INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D34A04ADC54C8C93 (type_id), INDEX IDX_D34A04ADAB43EC50 (fabric_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_136758812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES product_type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADAB43EC50 FOREIGN KEY (fabric_id) REFERENCES fabric (id)');
        $this->addSql('ALTER TABLE product_type ADD CONSTRAINT FK_136758812469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADAB43EC50');
        $this->addSql('ALTER TABLE product_type DROP FOREIGN KEY FK_136758812469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP TABLE fabric');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_type');
    }
}
