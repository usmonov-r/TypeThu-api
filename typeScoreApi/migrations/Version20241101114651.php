<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241101114651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'feat: textSnippet relationship property added to TestResult entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_result ADD text_snippet_id INT NOT NULL');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63DF2CEB0EF FOREIGN KEY (text_snippet_id) REFERENCES text_snippet (id)');
        $this->addSql('CREATE INDEX IDX_84B3C63DF2CEB0EF ON test_result (text_snippet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63DF2CEB0EF');
        $this->addSql('DROP INDEX IDX_84B3C63DF2CEB0EF ON test_result');
        $this->addSql('ALTER TABLE test_result DROP text_snippet_id');
    }
}
