<?php
require_once 'View.php';
Class ViewHome extends View {
    private string $message ;
    private array $datas ;

    public function __construct(string $message, array $datas) {
        $this->message = $message;
        $this->datas = $datas;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getDatas(): array {
        return $this->datas;
    }
    public function setMessage(string $newMessage): self {
        $this->message = $newMessage;
        return $this;
    }

    public function setDatas(array $newDatas): self {
        $this->datas = $newDatas;
        return $this;
    }

    // ajout des methodes de l'exercice

    public function displayMain(): self
{
    echo '<main>
        <h2>Ajouter un joueur</h2>

        <form action="" method="POST">

            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo"
                   name="pseudo" required>

            <label for="score">Score :</label>
            <input type="number" id="score"
                   name="score" required>

            <label for="team">Équipe :</label>
            <select id="team" name="team" required>
                <option value="1">Aucune</option>
                <option value="2">TeamRocket</option>
                <option value="3">DreamTeam</option>
            </select>

            <button type="submit">
                Ajouter le joueur
            </button>

        </form>';

    // Affichage du message
    if (!empty($this->message)) {
        echo '<p>' .
            htmlspecialchars($this->message) .
            '</p>';
    }

    // Affichage des joueurs
    echo '<h2>Liste des joueurs</h2>

        <table>
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Score</th>
                    <th>Équipe</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($this->datas as $joueur) {
        echo '<tr>
            <td>' . htmlspecialchars($joueur['pseudo']) . '</td>
            <td>' . htmlspecialchars((string)$joueur['score']) . '</td>
            <td>' . htmlspecialchars($joueur['team']) . '</td>
        </tr>';
    }

    echo '</tbody>
        </table>
    </main>';

    return $this;
}

public function displayAll(): void
{
    $this->displayHeader()
         ->displayMain()
         ->displayFooter();


}



}