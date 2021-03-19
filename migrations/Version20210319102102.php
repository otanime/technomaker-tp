<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\City;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319102102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $city = new City();
        $city->setName('Marrakech');
        $city->setZipcode('40014');

        $this->addSql('INSERT INTO city (name, zip_code) VALUE (:name, :zipCode)', array('name' => 'Marrakech', 'zipCode' => '40014'));

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
