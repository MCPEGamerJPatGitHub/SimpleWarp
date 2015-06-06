<?php
namespace falkirks\simplewarp;

use falkirks\simplewarp\permission\SimpleWarpPermissions;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

/**
 * The class that drives it all.
 *
 * Class Warp
 * @package falkirks\simplewarp
 */
class Warp{
    private $name;
    private $destination;
    private $isPublic;

    public function __construct($name, Destination $destination, $isPublic = false){
        $this->name = $name;
        $this->destination = $destination;
        $this->isPublic = $isPublic;
        SimpleWarpPermissions::setupPermission($this);
    }
    public function teleport(Player $player){
        $this->destination->teleport($player);
    }
    public function canUse(CommandSender $player){
        return ($this->isPublic || $player->hasPermission(SimpleWarpPermissions::BASE_WARP_PERMISSION) || $player->hasPermission(SimpleWarpPermissions::BASE_WARP_PERMISSION . "." . $this->name));
    }

    /**
     * @param boolean $isPublic
     */
    public function setPublic($isPublic = true){
        $this->isPublic = $isPublic;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return Destination
     */
    public function getDestination(){
        return $this->destination;
    }

    /**
     * @return boolean
     */
    public function isPublic(){
        return $this->isPublic;
    }

}