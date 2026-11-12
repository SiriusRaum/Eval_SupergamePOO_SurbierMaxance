<?php

require_once   'Controller.php';

class ControllerHome extends Controller
{
    // Récupération des joueurs
    public function displayPlayers(): self
    {
        $players = $this->getModel()->findAll();

        $this->getView()->setDatas($players);

        return $this;
    }

    // Enregistrement d'un joueur
    public function registerPlayer(): self
    {
        // Vérifier l'envoi du formulaire
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this;
        }

        // Vérifier la présence des champs
        if (
            !isset($_POST['pseudo']) ||
            !isset($_POST['score']) ||
            !isset($_POST['team'])
        ) {
            $this->getView()->setMessage(
                "Erreur : formulaire incomplet."
            );
            return $this;
        }

        // Récupération des données
        $pseudo = trim($_POST['pseudo']);
        $score = filter_var(
            $_POST['score'],
            FILTER_VALIDATE_INT
        );
        $idTeam = filter_var(
            $_POST['team'],
            FILTER_VALIDATE_INT
        );

        // Vérification du pseudo
        if (
            $pseudo === '' ||
            mb_strlen($pseudo) > 50
        ) {
            $this->getView()->setMessage(
                "Erreur : pseudo invalide."
            );
            return $this;
        }

        // Vérification du score
        if ($score === false || $score < 0) {
            $this->getView()->setMessage(
                "Erreur : score invalide."
            );
            return $this;
        }

        // Vérification de l'équipe
        if (
            $idTeam === false ||
            !in_array($idTeam, [1, 2, 3], true)
        ) {
            $this->getView()->setMessage(
                "Erreur : équipe invalide."
            );
            return $this;
        }

        // Récupération du modèle
        $model = $this->getModel();

        // Vérifier si le pseudo existe déjà
        $model->setPseudo($pseudo);

        if ($model->findByPseudo() !== false) {
            $this->getView()->setMessage(
                "Erreur : ce pseudo existe déjà."
            );
            return $this;
        }

        // Enregistrement des données
        $model->setScore($score);
        $model->setIdteam($idTeam);

        $model->add();

        // Message de confirmation
        $this->getView()->setMessage(
            "Le joueur a été ajouté avec succès !"
        );

        return $this;
    }
}