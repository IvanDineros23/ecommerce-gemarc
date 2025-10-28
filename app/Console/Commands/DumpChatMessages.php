<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DumpChatMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dump-chat-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = \App\Models\ChatMessage::all(['id', 'sender_id', 'receiver_id', 'message', 'created_at']);
        if ($messages->isEmpty()) {
            $this->info('No chat messages found.');
            return;
        }
        foreach ($messages as $msg) {
            $this->line("ID: {$msg->id} | Sender: {$msg->sender_id} | Receiver: {$msg->receiver_id} | Message: {$msg->message} | Date: {$msg->created_at}");
        }
    }
}
