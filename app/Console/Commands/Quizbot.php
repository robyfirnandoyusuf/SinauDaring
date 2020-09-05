<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Quizbot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quizbot:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starting quizbot';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->usernamebot      = "@SinauDaringBot";
        $this->token            = 'bot1260900135:AAE-Rm2D1Q3mBxO25pmCU1qYvukdMU5VDcs';
        $this->base_url         = 'https://api.telegram.org/'.$this->token;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while (true) 
        {
            $this->main();
        }
    }

    public function main()
    {
        $check      = $this->_getLastMessage();
        $jsonDec    = json_decode($check,true);
        $dataLast   = array_slice($jsonDec, -1, 1, true);
        $dataLast   = end($dataLast['result']);
        $offset     = (int)@$dataLast['update_id'] + 1;

        $getMostNew = $this->_getLastMessage($offset);

        if (!empty(json_decode($check)->result)) 
        {
            // self::log($check);
            echo "[+] => [New Message]\n";
            if (!empty($dataLast['message']['photo'][1])) // if send image and get medium size
            {
                echo "[+] => [New Message] - user sent an image !\n";
            }
            else
            {
                $dataLast['chat_id']    = $dataLast['message']['chat']['id'];
                $dataLast['message_id'] = $dataLast['message']['message_id'];
                $dataLast['text']       = $dataLast['message']['text'];
                $this->_send_message(null,$dataLast);
            }
        }
        else
        {
            echo "[-] => -\n";
        }
    }

    private function _getLastMessage($offset='')
    {
        $get_last = file_get_contents( $this->base_url.'/getUpdates'.(!empty($offset) ? "?offset=".$offset : ""));

        return $get_last;
    }

    public function _send_message($type='',$data)
    {
        $chatid = $data['chat_id'];
        $msgid  = $data['message_id'];
        $text   = $data['text'];
        $content = "";

        if (empty($type)) 
        {
            if(stripos($text, "/help") !== false)
            {
                $content .= '1. masukan nama lengkap';
                $content .= '2. masukan NISN';
                $content .= '3. masukan kelas';
                $content .= '4. masukan jurusan / prodi';
                $content .= '5. Masukkan kode dan token soal yang sudah diberikan oleh bapak/ibu gurumu';
                $content .= '6. setelah mengerjakan Anda akan mendapatkan skor';
            }
            elseif($text == '/mulai_ujian')
            {
                $content .= "Masukkan nama lengkap : ";
            }
        }

        $data = array(
            'chat_id'               => $chatid,
            'text'                  => $content,
            'reply_to_message_id'   => $msgid,
            // 'parse_mode'             => 'Markdown'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url."/sendMessage");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        $res = curl_exec($ch);
        var_dump ($res);
    }
}
