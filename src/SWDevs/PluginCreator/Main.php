<?php

namespace SWDevs\PluginCreator;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config as Cfg;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info(C::RED."PluginCreator Enabled!");
    
    @mkdir($this->getDataFolder());
  }
  
  public function onCommand(CommandSender $s, Command $cmd, $label, array $args){
    if(strtolwer($cmd->getName() == "crplg")){
      if(!isset($args[0])){
        $s->sendMessage(C::RED."[ERROR] Argument 1 is Empty! /crplg <help>");
      }else{
        if($s instanceof Player){
          $s->sendMessage(C::RED."[ERROR] CommandSender Is Not an Instanceof ConsoleCommandSender");
        }else{
          switch(strtolower($args[0])){
            case "help":
            $s->sendMessage(C::BLUE."<<<<< PLUGIN CREATOR HELP PAGE >>>>>");
            $s->sendMessage(C::RED."/crplg help - Help Page");
            $s->sendMessage(C::RED."/crplg <name of Plugin> <version> <event> <message> - Create a plugin with a message for the specified event.");
          }
        }
      }
    }
  }
}
