<?php
class Card {

  private $seme;
  private $valore;
  private $coloreDorso;
  private $coloreFaccia;

  public function __construct($s, $v, $cd, $cf) {
    $this->seme = $s;
    $this->valore = $v;
    $this->coloreDorso = $cd;
    $this->coloreFaccia = $cf;
  }

  public function getSeme()
  {
    return $this->seme;
  }

  public function getValore()
  {
    return $this->valore;
  }

  public function getColoreDorso()
  {
    return $this->coloreDorso;
  }
  public function getColoreFaccia()
  {
    return $this->coloreFaccia;
  }

  public function equals(Card $c)
  {
    if (($c->seme === $this->seme) && ($c->valore === $this->valore) && ($c->coloreDorso === $this->coloreDorso) && ($c->coloreFaccia === $this->coloreFaccia)) {
      return true;
    }
    return false;
  }



  public function __toString()
  {
    return "seme: ".$this->seme."<br>"."valore: ".$this->valore."<br>"."colore dorso: ".$this->coloreDorso."<br>"."colore faccia: ".$this->coloreFaccia."<br><br>";
  }

}


?>
