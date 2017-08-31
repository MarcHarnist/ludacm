<?php
class Personnage
{
  private $_id,
          $_name,
          $_mission,
		  $_life, // teste: on peut écrire par defaut $_life = 7;
		  $_agility, //register date of the player.
		  $_born, //register date of the player.
          $_password,
          $_lastconnection,
          $_nowconnection,
          $_totalconnection;
  
  const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
  const JOUEUR_PERDU = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
  const PENALTY = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
  // const JOUEUR_COURAGEUX = 4; // Constante renvoyée par la méthode  si on a fini le jeu.
  
  
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  public function frapper(Personnage $perso)
  {
    if ($perso->id() == $this->_id)//si le personnage POSTé est le même que celui frappé dans la DB
    {
      return self::CEST_MOI;
    }
	// On indique au personnage qu'il doit recevoir des dégâts.
    // Puis on retourne la valeur renvoyée par la méthode : self::JOUEUR_PERDU ou self::PENALTY
    return $perso->recevoirDegats();
	// return $perso->getMission();
  }
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);// if key = id, $method = setId;
      
      if (method_exists($this, $method)) // si la methode existe elle
                // est appellée    pour controler la valeur...
      {
        $this->$method($value);
      }
    }
  }
  
  public function recevoirDegats()
  {
    $this->_degats += 5;// 5 seront rajoutés dans la db
    $this->_mission += 1; // Si on a fini une mission on gagne 1-> +1 in db
    
	
	
    // Si on a 100 de dégâts ou plus, on dit que le personnage a été tué.
    if ($this->_degats >= 100)
    {
      return self::JOUEUR_PERDU; // ce perso est tué (self)
    }
    
    // Sinon, on se contente de dire que le personnage a bien été frappé.
    return self::PENALTY;
  }  
  
  // public function getMission()
  // {
	
	// $total_mission == 10; // après dix questions la partie est finie !
    // if ($this->_mission >= $total_mission)// si on a fait toutes les missions
    // {
      // return self::JOUEUR_COURAGEUX; // ce perso A FINI (self)
    // }
  // }
  
  public function getLife()
  {
    $this->_life += 1;
    
    // Si on a 0 vie on a perdu.
    if ($this->_degats == 0)
    {
      return self::JOUEUR_PERDU; // ce perso est tué (self)
    }
    
    // Sinon, on se contente de dire que le personnage a bien été frappé.
    return self::PENALTY;
  }
  
  
  // GETTERS //
  

  // public function degats()
  // {
    // return $this->_degats;
  // }  
  public function id()
  {
    return $this->_id;
  }
  public function name()
  {
    return $this->_name;
  } 
  public function life()
  {
    return $this->_life;
  }
  public function mission()
  {
    return $this->_mission;
  }
   public function agility()
  {
	return $this->_agility;
  }
  public function born()
  {
	return $this->_born;
  }
  public function password()
  {
    return $this->_password;
  }
  public function lastconnection()
  {
    return $this->_lastconnection;
  }
  public function nowconnection()
  {
    return $this->_nowconnection;
  }
  public function totalconnection()
  {
    return $this->_totalconnection;
  }
  
  // Rajout de Marc H. 05/08/17 avec fierté !
  public function nameValide() // Input name cannot be empty
  {
	return !empty($this->_name); // empty: the var exists but is empty.
  }
  public function passwordValide() // Input name cannot be empty
  {
	return !empty($this->_password); // empty: the var exists but is empty.
  }
  // Fin du rajout de Marc
  
  // public function setDegats($degats)
  // {
    // $degats = (int) $degats;
    
    // if ($degats >= 0 && $degats <= 100)
    // {
      // $this->_degats = $degats;
    // }
  // }
  public function setId($id)
  {
    $id = (int) $id;
    
    if ($id > 0)
    {
      $this->_id = $id;
    }
  }
  public function setName($name)
  {
    if (is_string($name))
    {
      $this->_name = $name;
    }
  }
    public function setLife($life)
  {
    $life = (int) $life;
    
    if ($life >= 0)
    {
      $this->_life = $life;
    }
  }
  public function setMission($mission)
  {
    $mission = (int) $mission;
    
    // if ($mission >= 0 && $mission <= 100)
    // {
      $this->_mission = $mission;
    // }
  }
  public function setAgility($agility)
  {
	 $agility = (int) $agility;
	if ($agility >= 0)
	{
		$this->_agility = $agility;
    }
  }
  public function setBorn($born)
  {
	 $born = (int) $born;
	if ($born >= 0)
	{
		$this->_born = $born;
    }
  }
  public function setPassword($password)
  {
	  if(is_string($password))
	  {
        $this->_password = $password;
	  }
  }
 
  public function setNowconnection($nowconnection)
  {
    $nowconnection = (int) $nowconnection;

    if($nowconnection >= 0)
	{
        $this->_nowconnection = $nowconnection;
	}
  }
  public function setLastconnection($lastconnection)
  {
    $lastconnection = (int) $lastconnection;

    if($lastconnection >= 0)
	{
        $this->_lastconnection = $lastconnection;
	}
  }
  public function setTotalconnection($totalconnection)
  {
    $totalconnection = (int) $totalconnection;

    if($totalconnection >= 0)
	{
        $this->_totalconnection = $totalconnection;
	}
  }
}