<?php
include_once 'Card.php';
//interfaccia stack  e  iterator
class SetterDeckException extends Exception {};
class MazzoVuotoException extends Exception {};

class CardDeck implements IteratorAggregate
{
  private $stack;
  private $stackCloned;
  private $dorsoSelezionato;
  private $arraySemi = array("cuori" => "rosso", "quadri" => "rosso", "fiori" => "nero", "picche" => "nero");
  private $valoreCarta =  array('asso', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'jack', 'donna', 're');
  private $coloriJolly = array('rosso', 'nero');
  public function __construct(){}

//setMazzo in base al colore del dorso scelto
  public function creaMazzo($dorso)
  {
    //formatto la string
    $dorso = strtoupper($dorso);
    if (($dorso == "ROSSO") or ($dorso == "BLU")){
      $this->dorsoSelezionato = $dorso;
      foreach ($this->arraySemi as $s =>$cf) {

        foreach ($this->valoreCarta as $va)
        {
          $this->stack[] = new Card($s, $va, $dorso, $cf);
        }
      }
    foreach ($this->coloriJolly as $cf) {
      $this->stack[] = new Card("star", "jolly", $dorso, $cf);
    }

    $this->stackCloned = $this->stack; //creo copia stack
    return $this->stack;
  } else {
    throw new SetterDeckException();

  }
}


//iterazione sugli oggetti
  public function getIterator()
  {
    if ($this->isEmpty()) {
      echo "Mazzo vuoto";
      break;
    } else {
      return new ArrayIterator($this->stack);
    }
  }

//check se vuoto, ritorna vero se è vuoto
  public function isEmpty()
  {
    return empty($this->stack);
  }

//verifica della presenza di una certa carta nel mazzo, ritorna true se viene trovata
  public function confrontoCartaArray(Card $newCard)
  {
    $trovata = false;
    if (!$this->isEmpty())
    {
      foreach ($this->stack as $key => $value)
      {
        if ($newCard == $value)
        {
          echo $newCard;
        //  echo "Trovata\n";
          return $trovata = true;
        }
      }
    } else
    {
      throw new MazzoVuotoException();
    }
    return $trovata = false;
  }


  //verifico che il formato della carta in input vada bene, confrontandolo con un secondo mazzo creato all'inizio del gioco
    public function checkInputCarta(Card $newCard)
    {
      $trovata = false;
      foreach ($this->stackCloned as $key => $value) {
        if ($newCard == $value) {
          return $trovata = true;
        }
      }
      return $trovata;
    }

  /*
    public function top()
    {
      return end($this->stack);
    }
*/
  //estrazione della carta successiva nella sequenza
    public function pop()
    {
      if ($this->isEmpty()) {
        echo "Mazzo vuoto";
        return null;
      }
        $card = array_pop($this->stack);
        return $card;
    }



//inserimento in cima al mazzo
public function push($newCard)
{
    if (!$this->checkInputCarta($newCard)) {
      echo "Carta non può essere gestita, formato errato";
    }
    else if ($this->confrontoCartaArray($newCard)) {
      //throw new CartaPresente("Carta già presente");
      echo "Carta già presente";
    }
    else {

      if(count($this->stack)<55){
        array_push($this->stack, $newCard);
        echo "CARTA INSERITA";
      }
      else {
        echo "Il mazzo è pieno";
      }
    }
}

//inserimento in fondo al mazzo
  public function insertFirst($newCard)
  {
    if (!$this->checkInputCarta($newCard)) {
      echo "Carta non può essere gestita";
    }
    else if ($this->confrontoCartaArray($newCard)) {
        echo "Carta già presente";
    }
    else {
        if(count($this->stack)<55){
          echo "Elemento inserito alla fine della pila.<br>";
          array_unshift($this->stack, $newCard);
        }
        else {
          echo "Il mazzo è pieno";
        }
    }
  }


//inserimento random all'interno mazzo
  public function insertRandom($newCard)
  {
    $destinationPosition = array_rand($this->stack);
    //echo $destinationPosition." ";
    $tmp = $this->stack[$destinationPosition];
  //  echo $destinationPosition." - - - ".$tmp;
  //  echo "<br>---------------Inserimento random----------------<br>";
    $subArray = array_slice($this->stack, $destinationPosition);
    $subA =  array_slice($this->stack, 0, $destinationPosition);
    array_push($subA, $newCard);
    $this->stack = array_merge($subA,$subArray);
    return $this->stack;
    foreach ($this->stack as $key => $value) {
  //    echo $key . "----->" .$value;
    }
    return array_splice($this->stack, $destinationPosition, 2, array($newCard, $tmp));
  }


//conteggio delle carte rimaste nel mazzo
  public function contaCarte()
  {
    if ($this->isEmpty()) {
      echo "Mazzo vuoto";
    }
    return sizeof($this->stack);
  }

//conteggio delle carte rimaste nel mazzo di un certo seme
  public function contaSeme($seme)
  {
    $count=0;
    if ($this->isEmpty()) {
      throw new UnderflowException("Mazzo vuoto");
    }
    foreach ($this->stack as $card) {
    if (!array_key_exists($seme, $arraySemi)) {
        if($card->getSeme() == $seme){
          $count = $count+1;
        }
      }
    else {
      echo "Seme non presente nel mazzo<br>";
    }
  }

    return $count;
  }


//mischiatura delle carte contenute nel mazzo
  public function shuffle()
  {
    if ($this->isEmpty()) {
      echo "Mazzo vuoto";
    }
      return shuffle($this->stack);

  }

//riordino delle carte contenute nel mazzo
  public function riordino()
  {
    if ($this->isEmpty()) {
      echo "Mazzo vuoto";
    }
    $presente = true;
    $tmp = $this->stackCloned;
    foreach ($tmp as $key => $value) {
      if(!in_array($value, $this->stack)) {
        unset($tmp[$key]);
      }
    }
    $this->stack = $tmp;

  }

}
/*
$c = new CardDeck();
$c->creaMazzo("Rosso");

$n = new Card("fiori", "5", "rosso", "nero");


/*foreach ($c as $key => $value) {
  echo $value;
}
echo "-----------------------------";
echo $c->pop();
//var_dump($ci);
echo "-----------------------------";
*/


?>
