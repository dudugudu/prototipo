<?php

namespace Utils;

class Notify {
    public function addMessage($message, $type = 'info') {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
        $_SESSION['messages'][] = [
            'type' => $type,
            'text' => $message,
        ];
    }
}

?>