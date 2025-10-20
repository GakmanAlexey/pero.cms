<?php

namespace Modules\D20\Controller;

Class Index extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/index.php";
        $this->show();
        $this->cashe_end();
    }

    public function player(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/player.php";
        $this->show();
        $this->cashe_end();
    }

    public function playerOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/playero.php";
        $this->show();
        $this->cashe_end();
    }

    public function npc(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/npc.php";
        $this->show();
        $this->cashe_end();
    }

    public function npcOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/npco.php";
        $this->show();
        $this->cashe_end();
    }

    public function town(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/town.php";
        $this->show();
        $this->cashe_end();
    }

    public function townOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/towno.php";
        $this->show();
        $this->cashe_end();
    }

    public function mobs(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/mobs.php";
        $this->show();
        $this->cashe_end();
    }

    public function mobsOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/mobso.php";
        $this->show();
        $this->cashe_end();
    }

    public function quests(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/quests.php";
        $this->show();
        $this->cashe_end();
    }

    public function questsOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/questso.php";
        $this->show();
        $this->cashe_end();
    }

    public function factions(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/factions.php";
        $this->show();
        $this->cashe_end();
    }

    public function factionsOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/factionso.php";
        $this->show();
        $this->cashe_end();
    }

    public function items(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/items.php";
        $this->show();
        $this->cashe_end();
    }

    public function itemsOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/itemso.php";
        $this->show();
        $this->cashe_end();
    }

    public function skils(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/skils.php";
        $this->show();
        $this->cashe_end();
    }

    public function skilsOpen(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $this->list_file[] = APP_ROOT."/modules/d20/view/skilso.php";
        $this->show();
        $this->cashe_end();
    }
}
