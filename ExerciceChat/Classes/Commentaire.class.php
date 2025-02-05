<?php

class Commentaire
{

    protected $pseudo;
    protected $message;
    protected $error = false;
    protected $msg = "";

    public function __construct($pseudo = "", $message = "")
    {
        $this->setPseudo($pseudo);
        $this->setMessage($message);
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function checkForm()
    {

        if (empty($this->pseudo) || empty($this->message)) {
            // Ici error passe sur true pour indiqué qu'il y a une erreur
            $this->error = true;
            $this->msg .= '<div class="alert alert-danger" role="alert">Veuillez saisir tous les champs s\'il vous plaît</div>';
        }

        if (iconv_strlen($this->pseudo) < 3 || iconv_strlen($this->pseudo) > 20) {
            // Ici error passe sur true pour indiqué qu'il y a une erreur
            $this->error = true;
            $this->msg .= '<div class="alert alert-danger" role="alert">Attention votre pseudo doit contenir au moins 3 lettres et maximum 20</div>';
        }
    }

    public function insertCommentaire($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
        $stmt->bindParam(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':message', $this->message, PDO::PARAM_STR);
        $stmt->execute();
        $this->msg .= '<div class="alert alert-success" role="alert">Message enregistré !</div>';
        return true;
    }

    public function selectAllMessages($pdo)
    {
       return $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC")->fetchAll();
    }
}
