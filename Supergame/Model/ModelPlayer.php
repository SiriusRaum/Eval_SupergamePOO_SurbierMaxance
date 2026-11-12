<?php
require_once 'Model.php';
class ModelPlayer extends Model {
// Mise en place des attibuts
    private int $id;
    private string $pseudo;
    private int $score;
    private string $team;
    private int $idteam;

// mise en place du constructeur
    public function __construct(int $id, string $pseudo, int $score, string $team, int $idteam) {
        parent::__construct();
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->score = $score;
        $this->team = $team;
        $this->idteam = $idteam;}

// mise en place des getters

    public function getId(): int {
        
        return $this->id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getScore(): int {
        return $this->score;
    }
    public function getTeam(): string {
        return $this->team;
    }
    public function getIdteam(): int {
        return $this->idteam;
    }

// mise en place des setters

    public function setId(int $newId): self {
        $this->id = $newId;
        return $this;
    }

    public function setPseudo(string $newPseudo): self {
        $this->pseudo = $newPseudo;
        return $this;
    }

    public function setScore(int $newScore): self {
        $this->score = $newScore;
        return $this;
    }

    public function setTeam(string $newTeam): self {
        $this->team = $newTeam;
        return $this;
    }

    public function setIdteam(int $newIdteam): self {
        $this->idteam = $newIdteam;
        return $this;
    }

//mise en place de find all

    public function findAll(): array {
        try {
            $sql ="SELECT p.id_player, p.pseudo, p.score, t.team, t.id_team
            FROM player p INNER JOIN team t ON p.id_team = t.id_team";
        $requete = $this->getBdd()->prepare($sql);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des joueurs : " . $e->getMessage());
        }
        
    }

//mise en place de find by pseudo

    public function findByPseudo(): array|bool
    {
        try {
            $sql = "SELECT * FROM player WHERE pseudo = :pseudo";

            $requete = $this->getBdd()->prepare($sql);

            $requete->execute([ "pseudo" => $this->getPseudo()
            ]);

            return $requete->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

// mise en place de add 

    public function add(): void {
        try {
            $sql = "INSERT INTO player (pseudo, score, id_team) VALUES (:pseudo, :score, :id_team)";
            $requete = $this->getBdd()->prepare($sql);
            $requete->execute([
                "pseudo" => $this->getPseudo(),
                "score" => $this->getScore(),
                "id_team" => $this->getIdteam()
            ]);
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout du joueur : " . $e->getMessage());
        }

//mise en place de delete
    }

    public function delete(): void {
        try {
            $sql = "DELETE FROM player WHERE id_player = :id_player";
            $requete = $this->getBdd()->prepare($sql);
            $requete->execute(["id_player" => $this->getId()]);
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du joueur : " . $e->getMessage());
        }
    }
//mise en place de update

    public function update(): void {
        try {
            $sql = "UPDATE player SET pseudo = :pseudo, score = :score, id_team = :id_team WHERE id_player = :id_player";
            $requete = $this->getBdd()->prepare($sql);
            $requete->execute([
                "pseudo" => $this->getPseudo(),
                "score" => $this->getScore(),
                "id_team" => $this->getIdteam(),
                "id_player" => $this->getId()
]);
        } catch (PDOException $e) {
            die("Erreur lors de la mise à jour du joueur : " . $e->getMessage());
        }
    }
}