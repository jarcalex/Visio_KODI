<?php
  class Mysql
  {
    private
      $Serveur     = '',
      $Bdd         = '',
      $Identifiant = '',
      $Mdp         = '',
      $Lien        = '',
      $Debogue     = true,
      $NbRequetes  = 0;
    /**
    * Constructeur de la classe
    * Connexion aux serveur de base de donnée et sélection de la base
    *
    * $Serveur     = L'hôte (ordinateur sur lequel Mysql est installé)
    * $Bdd         = Le nom de la base de données
    * $Identifiant = Le nom d'utilisateur
    * $Mdp         = Le mot de passe
    */
    public function __construct($Serveur = 'localhost', $Bdd = 'base', $Identifiant = 'root', $Mdp = '')
    {
      $this->Serveur     = $Serveur;
      $this->Bdd         = $Bdd;
      $this->Identifiant = $Identifiant;
      $this->Mdp         = $Mdp;
      $this->Lien=mysql_connect($this->Serveur, $this->Identifiant, $this->Mdp);
      if(!$this->Lien && $this->Debogue)
        throw new MySQLExeption('Erreur de connexion au serveur MySql!!!');
      $Base = mysql_select_db($this->Bdd,$this->Lien);
      if (!$Base && $this->Debogue)
        throw new MySQLExeption('Erreur de connexion à la base de donnees!!!');
    }
    /**
    * Retourne le nombre de requêtes SQL effectué par l'objet
    */
    public function RetourneNbRequetes()
    {
      return $this->NbRequetes;
    }
    /**
    * Envoie une requête SQL et récupère le résultât dans un tableau pré formaté
    *
    * $Requete = Requête SQL
    */
    public function TabResSQL($Requete)
    {
      $i = 0;
      $Ressource = mysql_query($Requete,$this->Lien);
      $TabResultat=array();
      if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
      while ($Ligne = mysql_fetch_assoc($Ressource))
      {
        foreach ($Ligne as $clef => $valeur) $TabResultat[$i][$clef] = $valeur;
        $i++;
      }
      mysql_free_result($Ressource);
      $this->NbRequetes++;
      return $TabResultat;
    }
    /**
    * Retourne le dernier identifiant généré par un champ de type AUTO_INCREMENT
    *
    */
    public function DernierId()
    {
        return mysql_insert_id($this->Lien);
    }
    /**
    * Envoie une requête SQL et retourne le nombre de table affecté
    *
    * $Requete = Requête SQL
    */
    public function ExecuteSQL($Requete)
    {
      $Ressource = mysql_query($Requete,$this->Lien);
      if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
      $this->NbRequetes++;
      $NbAffectee = mysql_affected_rows();
      return $NbAffectee;
    }
    public function GetGenre()
    {
      $i = 0;
      $Ressource = mysql_query('
SELECT genre.genre_id, genre.name, count(*) as nb
FROM genre, genre_link
WHERE genre.genre_id = genre_link.genre_id 
GROUP BY genre.genre_id 
ORDER BY nb DESC
LIMIT 12',$this->Lien);
      $TabResultat=array();
      if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
      while ($Ligne = mysql_fetch_assoc($Ressource))
      {
        $TabResultat[$i]["GENRE"] = $Ligne["name"];
        $TabResultat[$i]["NB"] = $Ligne["nb"];
        $i++;
      }
      mysql_free_result($Ressource);
      $this->NbRequetes++;
      return $TabResultat;
        
    }
    public function GetNew($idTable= 'idShow', $art = 'c06', $table = 'tvshow_view') {
        $i = 0;
        $Ressource = mysql_query('SELECT '.$idTable.' AS id, c00 AS Titre, '.$art.' AS Art, dateAdded  FROM '.$table.' ORDER BY dateAdded desc LIMIT 12');
        if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
        while ($Ligne = mysql_fetch_assoc($Ressource)) {
            foreach ($Ligne as $clef => $valeur) $TabResultat[$i][$clef] = $valeur;
            $i++;
        }
        mysql_free_result($Ressource);
        $this->NbRequetes++;
        return $TabResultat;
    }
    public function GetYearNB() {
       $Ressource = mysql_query("select distinct(YEAR(c05)) as GETYear, (SELECT count(*) from tvshowview where YEAR(c05) = GETYear) as NB from tvshowview ORDER BY YEAR(c05)",$this->Lien);
       if (!$Ressource and $this->Debogue) throw new MySQLExeption('Erreur de requête SQL!!!');
       while ($Ligne = mysql_fetch_assoc($Ressource))
       {
         $TabResultat[$Ligne["GETYear"]] = $Ligne["NB"];
       }
      mysql_free_result($Ressource);
      $this->NbRequetes++;
      return $TabResultat;
    }
  }
  /**
  * Gestion des erreurs avec les exeptions
  */
  class MySQLExeption  extends Exception
  {
    public function __construct($Msg) {
      parent :: __construct($Msg);
    }
    public function RetourneErreur() {
      $msg  = '<div style="margin-left:250px; width:400px"><strong>' . $this->getMessage() . '</strong>';
      $msg .= ' Ligne : ' . $this->getLine() . '</div>';
      return $msg;
    }
  }
?>
