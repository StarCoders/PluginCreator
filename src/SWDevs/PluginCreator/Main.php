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
        $s->sendMessage(C::RED."[ERROR] Argument 0 is Empty! /crplg <help>");
      }else{
        if($s instanceof Player){
          $s->sendMessage(C::RED."[ERROR] CommandSender Is Not an Instanceof ConsoleCommandSender");
        }else{
          switch(strtolower($args[0])){
            case "help":
            $s->sendMessage(C::BLUE."<<<<< PLUGIN CREATOR HELP PAGE >>>>>");
            $s->sendMessage(C::RED."/crplg help - Help Page");
            $s->sendMessage(C::RED."/crplg <name of Plugin> <version> <event> <message> - Create a plugin with a message for the specified event.");
            break;
          }
          $pname = array_shift($args);
          if(!is_numeric($args[1]) or is_null($args[1])){
            $s->sendMessage(C::RED."Argument 1 [Missing\Must be Numerical]! /crplg <name of Plugin> <version> <event> <message>");
          }else{
            $v = array_shift($args);
            if(!isset($args[2])){
              $s->sendMessage(C::RED."Please Specify a General PlayerEvent! /crplg <name of Plugin> <version> <event> <message>");
            }else{
              switch($args[2]){
                case "PlayerJoinEvent":
                break;
                case "PlayerDeathEvent":
                break;
                case "PlayerQuitEvent":
                break;
                default:
                  $s->sendMessage(C::RED."The Entered Argument 2 String is Invalid/Not a General PlayerEvent!");
                break;
              }
            }
            if(!isset($args[3])){
              $s->sendMessage(C::RED."You Must Type an Imploded String for Argument 3!");
            }else{
              $msg = implode($args, " ");
            }
          }
        }
      }
      // Technical Stuff
      $name = $s->getName();
      $dir = @mkdir("".$this->getDataFolder()."/".$pname."/src/".$name."");
      $file = new Config($dir."Main.txt", Config::ENUM);
      $code = array(
        "<?php",
        "namespace ".$name.";",
        "use pocketmine\plugin\PluginBase;",
        "use pocketmine\event\player\".$args[2].";"",
        "use pocketmine\event\Listener;",
        "use pocketmine\utils\TextFormat as C;",
        "class Main extends PluginBase implements Listener{",
        "",
        "}",
      );
      file_put_contents($file,$code);
    }
    return true;
  }
}
