<?php
include_once 'CardDeck.php';

/**
 *
 */
class Gioco
{
  private $mazzo;
  public function __construct(){
  }

  private function controlloColoreDorso($color)
  {
    $colore = strtolower($color);
    if ($colore == 'rosso' || $colore == 'nero' ) {
      return true;
    }
      return false;

  }
/**
* Il colore del dorso può essere solo rosso o blu.
*/
  public function setGioco($colore)
  {
    $this->mazzo = new CardDeck();
    if ($this->controlloColoreDorso($colore)) {
      try {
        $this->mazzo->creaMazzo($colore);
      } catch (SetterDeckException $e) {
        echo "<script>alert('Il mazzo non è stato creato. Riprovare.')</script>";
      }
      //$this->getMazzo();
    } else {
      echo "Colore non valido. Il dorso può essere solo rosso o blu.";
    }
  }

//stampa i valori delle carte del mazzo
  public function getMazzo()
  {
    foreach ($this->mazzo as $key => $value) {
      echo $value;
    }
  }

// Estrazione della carta n cima al mazzo
  public function estrazioneCartaSuccessiva()
  {
    echo "La carta estratta è : " . $this->mazzo->pop();
  }

  //return una nuova carta (da inserire)
  public function setNewCard($seme, $valore, $coloreDorso, $coloreFaccia)
  {
    $seme = strtolower($seme);
    $valore = strtolower($valore);
    $coloreDorso = strtoupper($coloreDorso);
    $coloreFaccia = strtolower($coloreFaccia);

    $newCard = new Card($seme, $valore, $coloreDorso, $coloreFaccia);
    //echo $newCard;
    //check il formato della carta
    try {
      if(!$this->mazzo->checkInputCarta($newCard)) {
        echo "Il formato della carta è errato";
        return null;
      }
      else {
        //check se presente nel mazzo
        if($this->mazzo->confrontoCartaArray($newCard)) {
          echo "Carta già presente nel mazzo\n";
          return null;
        } else {
          //echo "Carta non presente nel mazzo\n";
          return $newCard;
        }
      }
    } catch (MazzoVuotoException $e) {
      echo "Errore, il mazzo è vuoto, non è possibile eseguire il confronto";
    }


  }

/**
* AGGIUNGI Carta:
* Aggiungi in cima al mazzo
* Aggiungi in mezzo al Mazzo
* Aggiungi alla fine
*/


  public function aggiungiCartaInCima($newCard)
  {
    $this->mazzo->push($newCard);

  }

  public function aggiungiCartaPosRandom($newCard)
  {
    $this->mazzo->insertRandom($newCard);
  }

  public function aggiungiCartaInFondo($newCard)
  {
    $this->mazzo->insertFirst($newCard);
  }

  //Conteggio delle CartaPresenti nel Mazzo, ritorna il numero di carte nel mazzo
  public function getConteggioCarteMazzo()
  {
    echo $this->mazzo->contaCarte();
  }
//ritorna il numero di carte di un seme dato in input
  public function getConteggioSemeMazzo($seme)
  {
    $seme = strtolower($seme);
    $nSeme = $this->mazzo->contaSeme($seme);
    if ($nSeme == 0)
    {
      echo "Il seme non è presente";
    }
    else {
      echo "Il seme è presente in  ".$nSeme." carte";
    }
  }

//Mischia carte
  public function shuffleCarte()
  {
    $this->mazzo->shuffle();
  }
//riordina carte
  public function riordinaCarte()
  {
    $this->mazzo->riordino();
  }



}


$cd = new Gioco();
$cd->setGioco("Rosso");
echo "<br>--------G1-------------<br>";
$cd->estrazioneCartaSuccessiva();
echo "<br>--------G2-------------<br>";
$cd->estrazioneCartaSuccessiva();
echo "<br>--------G1-------------<br>";
$cd->estrazioneCartaSuccessiva();
echo "<br>-----------------------------<br>";
echo "Settare nuova carta";
$nuovaCarta = $cd->setNewCard("star", "jolly", "ROSSO", "nero");
echo $nuovaCarta;
echo "<br>------ Carte presenti sono: -----------------<br>";
$cd->getConteggioCarteMazzo();
echo "<br>------ Mischia carte -----------------<br>";

$cd->shuffleCarte();
$cd->getMazzo();
echo "<br>------ Riordina carte: -----------------<br>";
$cd->riordinaCarte();
$cd->getMazzo();
echo "LA CARTA ESTRATTA E' : ";
$cd->estrazioneCartaSuccessiva();
echo "<br>-----------------------------<br>";
echo "<brNUOVA CARTA: >".$nuovaCarta;
echo "<br Aggiungi carta in posizione random>";
echo "<br>-----------------------------<br>";
$cd->aggiungiCartaPosRandom($nuovaCarta);
$cd->getMazzo();
//echo "<br>-----------------------------<br>";
//$cd->aggiungiCartaInCima($nuovaCarta);
//echo "<br>-----------------------------<br>";
//$cd->getMazzo();
//echo "<br>-----------------------------<br>";
//echo "Aggiungi la carta creata in testa al mazzo<br>";
//$cd->aggiungiCartaInCima($nuovaCarta);
/*
echo "<br>-----------------------------<br>";
//echo "Aggiungi la carta creata in fondo al mazzo<br>";
//$cd->aggiungiCartaInFondo($nuovaCarta);
echo "<br>-----------------------------<br>";
$cd->getConteggioCarteMazzo();
echo "<br>";
$cd->getConteggioSemeMazzo("pi");
echo "<br>-----------------------------<br>";
$cd->getMazzo();
echo "<br>-----------------------------<br>";
echo "Riordina carte<br>";
$cd->riordinaCarte();
$cd->getMazzo();
echo "<br>-----------------------------<br>";
echo "<br>-----------------------------<br>";
echo "<br>-----------------------------<br>";
echo "Mischia carte<br>";
$cd->shuffleCarte();
$cd->getMazzo();
*/

//$cd->getMazzo();


//$cd->confrontoCartaArray()

?>
