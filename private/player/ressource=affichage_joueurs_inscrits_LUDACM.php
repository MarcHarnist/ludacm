 

<!--  ce texte se colle à la ligne 522 juste après l'affichage des questions du jeu ludacm/view/game/game.php -->
 <fieldset>
                <legend>Joueurs inscrits: </legend>
                <p>
                <?php
                  // }
                  echo "";
                  
                  $persos = $manager->getList($perso->name()); // on affichera les questions de Isa
                  
                        foreach ($persos as $unPerso)
                        {
                          $life_w = "vie";
                          $mission_w = "mission";
                          $point_w = "point";
                          
                          $born = $unPerso->born();
                          $born = date('d/m/Y', $born);
                          $life = $unPerso->life();
                          $mission = $unPerso->mission();
                          $agility = $unPerso->agility();
                          
                          if($life > 1)
                          {
                              $life_w = "vies";
                          }
                          if($mission > 1)
                          {
                              $mission_w = "missions";
                          }
                          if($agility > 1)
                          {
                              $point_w = "points";
                          }
                          
                          $mission = $unPerso->mission();
                          echo  htmlspecialchars($unPerso->name()), '
                                </a> enregistré le : ' .  $born,' a ', $life,' ',$life_w,', a accompli ',$mission, ' ', $mission_w,' et possède ', $unPerso->agility(),' ',$point_w,' d\'agilité.<br />';
                        }
                  ?>
                  </p>
                  </fieldset>
