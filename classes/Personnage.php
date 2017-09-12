<?php
/* by OpenClassRoom 2017 */
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
          $_totalconnection,
		  $_lastquestion;
		  
  const PERDU = 0; // 0 vies = perdu // MY FIRST successfull Pahamaïm Nekutotaïm !
  
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
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
  
    foreach ($donnees as $key => $value)
    {
      $method = 'add'.ucfirst($key);// if key = id, $method = setId;
      
      if (method_exists($this, $method)) // si la methode existe elle
                // est appellée    pour controler la valeur...
      {
        $this->$method($value);
      }
    }
  }
  
  
  
  public function getLife()
  {
    $this->_life += 1;
    
    // Si on a 0 vie on a perdu.
    if ($this->_life == 0)
    {
      return self::JOUEUR_PERDU; // ce perso est tué (self)
    }
  }
  
  
  // GETTERS //
  

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
  public function lastquestion()
  {
	  return $this->_lastquestion;
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
  public function setLastquestion($lastquestion)
  {
	$lastquestion = (int) $lastquestion;
	  
      $this->_lastquestion = $lastquestion;
  }
  
  // function "add..."
  
    public function addLastquestion()
  {
      $this->_lastquestion += 1;
  }

}//Close class Personnage