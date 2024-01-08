<?php
/* Etant donné que l'autre code proposé dans les documents n'était pas très fonctionnel, j'ai allié ChatGPT ainsi que différentes aides sur Internet pour générer mon truc à moi */
class Upload {
    private $extensions;
    private $chemin;
    private $taille;

    /**
     * Constructeur de la classe Upload.
     *
     * @param array  $extensions  Liste des extensions autorisées.
     * @param string $chemin      Chemin vers le répertoire de stockage des fichiers.
     * @param int    $taille      Taille maximale du fichier en Ko.
     */
    public function __construct($extensions, $chemin, $taille)
    {
        $this->extensions = $extensions;
        $this->chemin = $chemin;
        $this->taille = $taille;
    }

    /**
     * Enregistre le fichier uploadé.
     *
     * @param string $data Nom du champ du formulaire.
     *
     * @return array Tableau contenant le nom du fichier et les éventuelles erreurs.
     */
    public function enregistrer($data)
    {
        $fichier = array('nom' => null, 'erreur' => null);
        $msg = null;

        if (isset($_FILES[$data]) && !empty($_FILES[$data]['name'])) {
            $extension = pathinfo($_FILES[$data]['name'], PATHINFO_EXTENSION);

            if (!in_array($extension, $this->extensions)) {
                $msg = 'Veuillez sélectionner un fichier de type : ' . implode(', ', $this->extensions);
            } elseif (file_exists($_FILES[$data]['tmp_name']) && (filesize($_FILES[$data]['tmp_name']) > $this->taille)) {
                $msg = 'Votre fichier doit faire moins de ' . $this->taille . ' Ko!';
            } else {
                $fichier['nom'] = $this->genererNomUnique($extension);
                move_uploaded_file($_FILES[$data]['tmp_name'], $this->chemin . '/../images/' . $fichier['nom']);
            }
        }
        $fichier['erreur'] = $msg;
        return $fichier;
    }

    /**
     * Génère un nom de fichier unique.
     *
     * @param string $extension Extension du fichier.
     *
     * @return string Nom de fichier unique.
     */
    private function genererNomUnique($extension)
    {
        return uniqid() . '.' . $extension;
    }
}
?>
