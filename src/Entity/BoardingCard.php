<?php

namespace App\Entity;

class BoardingCard {

    public $type;
    public $transportation;
    public $source;
    public $destination;
    public $seat;
    public $gate;
    public $baggage;

    public function __construct($type, $transportation, $source, $destination, $seat = null, $gate = null, $baggage = null)
    {
        $this->type= $type;
        $this->transportation = $transportation;
        $this->source = $source;
        $this->destination = $destination;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->baggage = $baggage;
    }

    public function getDescription(){
        $description = '';
        if($this->type == 'flight'){
            $description .= sprintf('From %s, take flight %s to %s. Gate %s, seat %s.', $this->source,$this->transportation, $this->destination, $this->gate, $this->seat);
        }else{
            $description .= sprintf("Take %s from %s to %s. ", $this->transportation, $this->source, $this->destination);
        }

        if ($this->seat && $this->type != 'flight') {
            $description .= sprintf("Sit in seat %s. ", $this->seat);
        }elseif (!$this->seat){
            $description .= "No seat assignment. ";
        }
        return $description;
    }
}