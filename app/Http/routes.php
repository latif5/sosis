<?php

use \Faker\Factory;

use App\Inbox;
use App\Outbox;
use App\Confirmation;

Route::resource('guest', 'GuestController',
        ['only' => ['index', 'login']]);

Route::get('login', ['as' => 'home.login', 'uses' => 'HomeController@login']);
Route::post('authenticate', ['as' => 'home.login.post', 'uses' => 'HomeController@index']);
Route::resource('home', 'HomeController',
        ['only' => ['index']]);

Route::post('send/reply', ['as' => 'send.reply', 'uses' => 'SendController@reply']);
Route::post('send/forward', ['as' => 'send.forward', 'uses' => 'SendController@forward']);
Route::resource('send', 'SendController',
        ['only' => ['create', 'store']]);

Route::get('inbox/delete/{inbox}', ['as' => 'inbox.delete', 'uses' => 'InboxController@delete']);
Route::resource('inbox', 'InboxController',
        ['only' => ['index']]);

Route::get('outbox/delete/{outbox}', ['as' => 'outbox.delete', 'uses' => 'OutboxController@delete']);
Route::get('outbox/truncate', ['as' => 'outbox.truncate', 'uses' => 'OutboxController@truncate']);
Route::resource('outbox', 'OutboxController',
        ['only' => ['index', 'destroy']]);

Route::get('sentitem/delete/{sentitem}', ['as' => 'sentitem.delete', 'uses' => 'SentItemController@delete']);
Route::resource('sentitem', 'SentItemController',
        ['only' => ['index']]);

Route::get('contact/delete/{contact}', ['as' => 'contact.delete', 'uses' => 'ContactController@delete']);
Route::resource('contact', 'ContactController',
        ['only' => ['index', 'create', 'store', 'edit', 'update']]);

Route::get('group/delete/{group}', ['as' => 'group.delete', 'uses' => 'GroupController@delete']);
Route::resource('group', 'GroupController',
        ['only' => ['index', 'create', 'store', 'edit', 'update']]);

Route::resource('balance',  'BalanceController',
        ['only' => ['index']]);

Route::resource('user', 'UserController',
        ['only' => ['index', 'create']]);

Route::resource('setting',  'SettingController',
        ['only' => ['index']]);

Route::get('confirmation/delete/{confirmation}', ['as' => 'confirmation.delete', 'uses' => 'ConfirmationController@delete']);
Route::get('confirmation/{confirmation}/{status}', ['as' => 'confirmation.status', 'uses' => 'ConfirmationController@status']);
Route::resource('confirmation',  'ConfirmationController',
        ['only' => ['index']]);

Route::get('donation/delete/{donation}', ['as' => 'donation.delete', 'uses' => 'DonationController@delete']);
Route::get('donation/{donation}/{status}', ['as' => 'donation.status', 'uses' => 'DonationController@status']);
Route::resource('donation',  'DonationController',
        ['only' => ['index']]);

Route::get('fin', function (){
        $inbox_all = Inbox::where('Processed', 'false')->get();

        foreach ($inbox_all as $inbox) {
            
            // Membaca id SMS
            $id = $inbox->ID;
            // Membaca pengirim SMS
            $no_pengirim = $inbox->SenderNumber;
            // Membaca isi SMS
            $isi = $inbox->TextDecoded;

            // Memecah isi sms
            $pecah = explode('#', $isi);

            // Pesan hanya direspon jika nomor lebih dari 3 digit
            if (strlen($no_pengirim) >= 3) {
                    
                /**
                 * Untuk keyword Konfirmasi
                 *
                 */
                if (strtoupper($pecah[0]) == 'KONFIRMASI' or strtoupper($pecah[0]) == 'KONFIRMASI ' or strtoupper($pecah[0]) == ' KONFIRMASI ') {
                    
                        // Membaca data dari pecahan sms berdasarkan format
                        // Konfirmasi#nama santri#kelas#jumlah#tanggal kirim#nama pengirim#keperluan kirim
                        $nomor_pengirim_balasan = $no_pengirim;
                        $nama_santri_balasan = str_replace("'", "\'", strtoupper($pecah[1]));
                        $kelas_balasan = str_replace("'", "\'", strtoupper($pecah[2]));
                        $jumlah_balasan = str_replace("'", "\'", strtoupper($pecah[3]));
                        $tanggal_kirim_balasan = str_replace("'", "\'", strtoupper($pecah[4]));
                        $nama_pengirim_balasan = str_replace("'", "\'", strtoupper($pecah[5]));
                        $keperluan_kirim_balasan = str_replace("'", "\'", strtoupper($pecah[6]));

                        // SMS balasan
                        $isi_balasan = "Konfirmasi pngrman utk $nama_santri_balasan sejmlh $jumlah_balasan utk kprluan $keperluan_kirim_balasan akn sgr kmi proses.";

                        $outbox = new Outbox;
                        $outbox->DestinationNumber = $nomor_pengirim_balasan;
                        $outbox->TextDecoded = $isi_balasan;
                        $outbox->save();

                        // Salin data 
                        $confirmation = new Confirmation;
                        $confirmation->tanggal = '2015-07-01 00:00:00';
                        $confirmation->ponsel = $nomor_pengirim_balasan;
                        $confirmation->santri = $nama_santri_balasan;
                        $confirmation->kelas = $kelas_balasan;
                        $confirmation->jumlah = $jumlah_balasan;
                        $confirmation->tanggal_kirim = $tanggal_kirim_balasan;
                        $confirmation->pengirim = $nama_pengirim_balasan;
                        $confirmation->keperluan = $keperluan_kirim_balasan;
                        $confirmation->save();


                }

            }

            // Jadikan true
            Inbox::find($id)->update([
                'Processed' => 'true'
            ]);

        }
});

