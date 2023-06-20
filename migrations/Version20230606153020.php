<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606153020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_shop_user ADD sponsor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_shop_user ADD CONSTRAINT FK_7C2B748012F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sylius_shop_user (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_7C2B748012F7FB51 ON sylius_shop_user (sponsor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_shop_user DROP FOREIGN KEY FK_7C2B748012F7FB51');
        $this->addSql('DROP INDEX IDX_7C2B748012F7FB51 ON sylius_shop_user');
        $this->addSql('ALTER TABLE sylius_shop_user DROP sponsor_id');
    }
}
