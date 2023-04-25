<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425210450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_shop_user ADD sponsorship_coupon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_shop_user ADD CONSTRAINT FK_7C2B7480644B637E FOREIGN KEY (sponsorship_coupon_id) REFERENCES sylius_promotion_coupon (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C2B7480644B637E ON sylius_shop_user (sponsorship_coupon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_shop_user DROP FOREIGN KEY FK_7C2B7480644B637E');
        $this->addSql('DROP INDEX UNIQ_7C2B7480644B637E ON sylius_shop_user');
        $this->addSql('ALTER TABLE sylius_shop_user DROP sponsorship_coupon_id');
    }
}
