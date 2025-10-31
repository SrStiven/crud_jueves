<?php

namespace App\Observers;

use App\Models\Books;
use App\Models\Event;
use App\Models\Log;

class BookObserver
{
    public function created(Books $book)
    {
        $this->logAction($book, 'create');
    }

    public function updated(Books $book)
    {
        $changes = $book->getChanges(); // solo los campos modificados
        $this->logAction($book, 'update', $changes);
    }

    public function deleted(Books $book)
    {
        $this->logAction($book, 'delete');
    }

    private function logAction(Books $book, string $action, $details = null)
    {
        $event = Event::where('name', $action)->first();

        if ($event) {
            $log = new Log();
            $log->book_id = $book->id;
            $log->event_id = $event->id;
            $log->user = 'Sistema'; // o 'Admin', si deseas identificar usuarios
            $log->details = $details ? json_encode($details, JSON_UNESCAPED_UNICODE) : null;
            $log->save();
        }
    }
}
