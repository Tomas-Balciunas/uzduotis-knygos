<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227121648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autorius (id INT AUTO_INCREMENT NOT NULL, vardas VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE knyga (id INT AUTO_INCREMENT NOT NULL, autorius_id INT DEFAULT NULL, pavadinimas VARCHAR(255) NOT NULL, isleidimo_metai DATE NOT NULL, isbn VARCHAR(17) NOT NULL, INDEX IDX_B810CE00CB8D7579 (autorius_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE knyga ADD CONSTRAINT FK_B810CE00CB8D7579 FOREIGN KEY (autorius_id) REFERENCES autorius (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE knyga DROP FOREIGN KEY FK_B810CE00CB8D7579');
        $this->addSql('DROP TABLE autorius');
        $this->addSql('DROP TABLE knyga');
    }
}
