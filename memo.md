symfony new ........

php bin/console c:c  -> nettoie le cache

symfony serve -> lance le serveur de symfony

php bin/console debug:router -> liste des routes

composer r orm -> installe Doctrine pour les Entités (modifier le .env)

composer r maker -> maker bundle

composer r validator -> valider les formulaires

composer req debug --dev -> debugger

composer req profiler --dev -> le profiler

composer r annotations -> les annotations




use Symfony\Component\Uid\Uuid;

class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private $id;

    public function getId(): ?Uuid
    {
        return $this->id;
    }


