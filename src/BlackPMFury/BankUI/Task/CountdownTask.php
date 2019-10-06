<?php

namespace BlackPMFury\BankUI\Task;

use BlackPMFury\BankUI\Main;
use pocketmine\scheduler\Task;
use pocketmine\Player;

class CountdownTask extends Task{

    public $seconds = 3600;

    public function __construct(Main $plugin, Player $player)
    {
        $this->player = $player;
        $this->plugin = $plugin;
    }

    public function onRun($tick): void{
        $this->player->sendPopup($this->plugin->tag . "§aCountdown §e".$this->seconds." §aSeconds/Day For Paycheck!");
        $this->player->sendMessage($this->plugin->tag . "§c Checked Nigga!");
        if($this->seconds === 0){
            $name = $this->player->getName();
            if(in_array($name, $this->plugin->tasks)){
                unset($this->plugin->tasks[array_search($name, $this->plugin->tasks)]);
                $this->plugin->tasks[$this->player->getId()]->getHandler()->cancel();
                $this->player->sendPopup($this->plugin->tag . "§a Bạn nhận được 5000 SAD trong Ngân Hàng");
                $this->player->sendMessage($this->plugin->tag . "§c Checked Nigga!");
                $this->player->sendMessage($this->plugin->tag . "§l§a Bạn Đã Online§e ".$this->plugin->seeTax($name)."§a Giờ!");
                $this->plugin->congTien($name, 5000);
                $this->plugin->addTaxUser($name, 1);
            }
        }
    }
}