<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103230023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, state VARCHAR(255) NOT NULL, seller VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('
                INSERT INTO `article` (`id`, `reference`, `price`, `state`, `seller`) VALUES
                    (1,	\'video-games\',	30.99,	\'Neuf\',	\'Abc jeux\'),
                    (2,	\'video-games\',	29,	\'Comme neuf\',	\'Diffusion-133\'),
                    (3,	\'video-games\',	24.44,	\'Bon état\',	\'Tous-les-jeux\'),
                    (4,	\'video-games\',	21.5,	\'Très bon état\',	\'Top-Jeux-video\'),
                    (5,	\'video games\',	20,	\'Très bon état\',	\'Micro-jeux\'),
                    (6,	\'video-games\',	16.2,	\'Etat moyen\',	\'Games-planete\'),
                    (7,	\'video-games\',	14.1,	\'Etat moyen\',	\'Abc jeux\')
                ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
    }
}
