<?php
/* by OpenClassRoom 2017 */

class PersonnagesManager // c'est un objet qui a une seule valeur: la base de donnée
            // la db est un tableau, array. La db = un objet
{
  private $_db; // Instance de PDO
  
  public function __construct($db)
  {
    $this->setDb($db);
  }
  // Création d'une ligne dans la base de donnée
  public function add(Personnage $perso)
  { // It works! lifes are informed in db, in table player
    $q = $this->_db->prepare('INSERT INTO player(name, life, mission, agility, born, password, lastconnection, nowconnection, totalconnection, lastquestion) VALUES(:name, :life, :mission, :agility, :born, :password, :lastconnection, :nowconnection, :totalconnection,  :lastquestion)');
    $q->bindValue(':name', $perso->name());
    $q->bindValue(':life', $perso->life());
    $q->bindValue(':mission', $perso->mission());
	$q->bindValue(':agility', $perso->agility());
	$q->bindValue(':born', $perso->born());
	$q->bindValue(':password', $perso->password());
	$q->bindValue(':lastconnection', $perso->lastconnection());
	$q->bindValue(':nowconnection', $perso->nowconnection());
	$q->bindValue(':totalconnection', $perso->totalconnection());
	$q->bindValue(':lastquestion', $perso->lastquestion());
    $q->execute();
    
    $perso->hydrate([
      'id' => $this->_db->lastInsertId(),
      // 'degats' => 0,
    ]);
  }
  
  // On compte les inscrits
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM player')->fetchColumn();
  }
  
  // Lecture de la base de donnée pour voir si tel id ($info) y est
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM player WHERE id = '.$info)->fetchColumn();
    }
    // Sinon, c'est qu'on veut vérifier que le name existe ou pas.
    $q = $this->_db->prepare('SELECT COUNT(*) FROM player WHERE name = :name');
    $q->execute([':name' => $info]);
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT * FROM player WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      return new Personnage($donnees);
    }
    else
    {
      $q = $this->_db->prepare('SELECT * FROM player WHERE name = :name');
      $q->execute([':name' => $info]);
      return new Personnage($q->fetch(PDO::FETCH_ASSOC));
    }
  }
  
  public function getList($name)
  {
    $persos = [];
    $q = $this->_db->prepare('SELECT * FROM player WHERE name <> :name ORDER BY name');
    $q->execute([':name' => $name]);
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }
    
    return $persos;
  }
  
  public function update(Personnage $perso)
  {
    $q = $this->_db->prepare('UPDATE player SET name = :name, life = :life, mission = :mission, agility = :agility, born = :born, password = :password, lastconnection = :lastconnection, nowconnection = :nowconnection, totalconnection = :totalconnection, lastquestion = :lastquestion  WHERE id = :id');
    
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    $q->bindValue(':name', $perso->name(), PDO::PARAM_STR);
    $q->bindValue(':life', $perso->life(), PDO::PARAM_INT);
    $q->bindValue(':mission', $perso->mission(), PDO::PARAM_INT);
	$q->bindValue(':agility', $perso->agility(), PDO::PARAM_INT);
	$q->bindValue(':born', $perso->born(), PDO::PARAM_INT);
	$q->bindValue(':password', $perso->password(), PDO::PARAM_INT);
	$q->bindValue(':lastconnection', $perso->lastconnection(), PDO::PARAM_INT);
	$q->bindValue(':nowconnection', $perso->nowconnection(), PDO::PARAM_INT);
    $q->bindValue(':totalconnection', $perso->totalconnection(), PDO::PARAM_INT);
    $q->bindValue(':lastquestion', $perso->lastquestion(), PDO::PARAM_INT);
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}