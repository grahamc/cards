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
    valid_cmd($line);
    
    $args = explode(' ', $line);
    $cmd = array_shift($args);
    
    $args = array_values($args);
    
    try {
        switch ($cmd) {
            case 'help':
                echo "commands: mv <from> <number> <to> " . PHP_EOL;
                echo "mv <stack> <destination>" . PHP_EOL;
                echo "ls <stack>" . PHP_EOL;
                echo "save" . PHP_EOL;
                break;
            case 'move':
            case 'mv':
                if (count($args) === 3) {
                    $game->moveVisible($args[0], $args[1], $args[2]);
                } else {
                    $game->moveVisibleToDestination($args[0], $args[1]);
                }
                break;
            
            case 'ls':
                $game->moveHiddenToVisible($args[0]);
                break;
            
            case 'save':
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
                break;
            
            default:
                throw new InvalidArgumentException('Invalid command: ' . $line);
                break;
        }
    } catch (Exception $e) {
        echo chr(27).'[1;31m' . $e->getMessage() . chr(27) . '[0m' . "\r\n";
    }
}

echo "You won!";