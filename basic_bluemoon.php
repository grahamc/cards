<?php
require_once 'bootstrap.php';

// colorize: echo chr(27).'[1;31mHi!' . chr(27) . '[0m';

class Deck_BlueMoon_Stacked extends Deck_BlueMoon {
	public function shuffle() {
		parent::shuffle();
	}
}

if (file_exists('.datastore')) {
    $game = unserialize(file_get_contents('.datastore'));
} else {
    $game = new Game();
}

function valid_cmd($line) {
    readline_add_history($line);
    system('clear');
}

while (!$game->getDeck()->isWon()) {
    $game->display();
    $line = readline('$');
    
    $args = explode(' ', $line);
    $cmd = array_shift($args);
    
    $args = array_values($args);
    
    switch ($cmd) {
        case 'mv':
            valid_cmd($line);
            if (count($args) === 3) {
                $game->moveVisible($args[0], $args[1], $args[2]);
            } else {
                $game->moveVisibleToDestination($args[0], $args[1]);
            }
            break;
            
        case 'ls':
            valid_cmd($line);
            $game->moveHiddenToVisible($args[0]);
            break;
            
        case 'save':
            valid_cmd($line);
            file_put_contents('.datastore', serialize($game));
            break;
            
        case 'abort':
            file_put_contents('.datastore', null);
            exit(0);
            break;
            
        case 'exit':
            exit();
            break;
            
        case 'clear':
            valid_cmd($line);
            break;
            
        default:
            system('clear');
            echo $line . ' is invalid.' . PHP_EOL;
            break;
    }
}
echo "You won!";




