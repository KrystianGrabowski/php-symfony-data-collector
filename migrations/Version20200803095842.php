<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803095842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ad_stats_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ad_stats_settings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ad_stats (id INT NOT NULL, url VARCHAR(255) NOT NULL, tags TEXT DEFAULT NULL, date DATE NOT NULL, estimated_revenue DOUBLE PRECISION NOT NULL, ad_impressions INT NOT NULL, ad_ecpm DOUBLE PRECISION NOT NULL, clicks INT NOT NULL, ad_ctr DOUBLE PRECISION NOT NULL, ad_settings_id INT NOT NULL, source_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX ad_stats_constraint ON ad_stats (url, tags, date)');
        $this->addSql('CREATE TABLE ad_stats_settings (id INT NOT NULL, currency VARCHAR(50) NOT NULL, period_length INT NOT NULL, group_by VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX ad_stats_settings_constraint ON ad_stats_settings (currency, period_length)');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, url TEXT NOT NULL, is_active BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX source_constraint ON source (url)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ad_stats_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ad_stats_settings_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP TABLE ad_stats');
        $this->addSql('DROP TABLE ad_stats_settings');
        $this->addSql('DROP TABLE source');
    }
}
