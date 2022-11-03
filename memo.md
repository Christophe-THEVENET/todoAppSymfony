symfony new ........

php bin/console c:c  -> nettoie le cache (si il y a une erreur de syntaxe ca pete)

symfony serve -> lance le serveur de symfony

php bin/console debug:router -> liste des routes

composer r orm -> installe Doctrine pour les Entités (modifier le .env)

composer r maker -> maker bundle

composer r validator -> valider les formulaires

composer req debug --dev -> debugger

composer req profiler --dev -> le profiler

composer r annotations -> les annotations

composer r twig -> twig




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



php bin/console doctrine:migrations:status


php bin/console doctrine:migrations:diff -> diff entre local est serveur



bien lire la migration


php bin/console doctrine:migrations:migrate

composer r form