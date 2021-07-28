<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728122543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8244BE22A76ED395 ON film (user_id)');
        $this->addSql('ALTER TABLE impression ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE impression ADD CONSTRAINT FK_245BB1B1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_245BB1B1A76ED395 ON impression (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22A76ED395');
        $this->addSql('DROP INDEX IDX_8244BE22A76ED395 ON film');
        $this->addSql('ALTER TABLE film DROP user_id');
        $this->addSql('ALTER TABLE impression DROP FOREIGN KEY FK_245BB1B1A76ED395');
        $this->addSql('DROP INDEX IDX_245BB1B1A76ED395 ON impression');
        $this->addSql('ALTER TABLE impression DROP user_id');
    }
}
