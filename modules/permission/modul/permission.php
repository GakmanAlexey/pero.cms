<?php

namespace Modules\Permission\Modul;

class Permission{
    private $pex = [];
    public function set_pex($pex){
        if (is_array($pex)) {
            foreach ($pex as $p) {
                $this->add_single_pex($p);
            }
        } else {
            $this->add_single_pex($pex);
        }
        return $this;
    }

    private function add_single_pex($pex) {
        if (!in_array($pex, $this->pex, true)) {
            $this->pex[] = $pex;
        }
    }

    public function get_pex() {
        return $this->pex;
    }

    public function has_pex($pex) {
        return in_array($pex, $this->pex, true);
    }

    public function remove_pex($pex) {
        $index = array_search($pex, $this->pex, true);
        if ($index !== false) {
            unset($this->pex[$index]);
            $this->pex = array_values($this->pex);
        }
        return $this;
    }
    
    public function clear_pex() {
        $this->pex = [];
        return $this;
    }
}