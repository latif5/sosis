<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\SendController;

use App\Inbox;
use App\Outbox;
use App\Confirmation;
use App\Donation;
use App\Psb;

class SosisService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sosis:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service SOSIS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Mengeksekusi perintah.
     *
     * @return mixed
     */
    public function handle()
    {
        $inbox_all = Inbox::where('Processed', 'false')->get();

        foreach ($inbox_all as $inbox)
        {
            
            // Membaca id SMS
            $id = $inbox->ID;
            // Membaca pengirim SMS
            $no_pengirim = $inbox->SenderNumber;
            // Membaca isi SMS
            $isi = $inbox->TextDecoded;
            // Membaca waktu pengiriman SMS
            $waktu_konfirmasi = $inbox->ReceivingDateTime;

            // Memecah isi sms
            $pecah = explode('#', $isi);
                    
            // Pesan akan direspon jika nomor pengirim lebih dari 8 digit
            if (strlen($no_pengirim) >= 9)
            {
                /**
                 * Untuk keyword KONFIRMASI
                 */
                if (strtoupper(@$pecah[0]) == 'KONFIRMASI' or strtoupper(@$pecah[0]) == 'KONFIRMASI ' or strtoupper(@$pecah[0]) == ' KONFIRMASI ')
                {
                    
                    // Membaca data dari pecahan sms berdasarkan format
                    // konfirmasi # nama santri # kelas # jumlah#tanggal kirim # nama pengirim # keperluan kirim
                    $nomor_pengirim_balasan = $no_pengirim;
                    $nama_santri_balasan = str_replace("'", "\'", strtoupper(@$pecah[1]));
                    $kelas_balasan = str_replace("'", "\'", strtoupper(@$pecah[2]));
                    $jumlah_balasan = str_replace("'", "\'", strtoupper(@$pecah[3]));
                    $tanggal_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[4]));
                    $nama_pengirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[5]));
                    $keperluan_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[6]));

                    // SMS balasan
                    $isi_balasan = "Konfirmasi pngrman utk $nama_santri_balasan sejmlh $jumlah_balasan utk kprluan $keperluan_kirim_balasan akn sgr kmi proses.";

                    $send = new SendController;
                    $send->send($nomor_pengirim_balasan, $isi_balasan);

                    // Salin data 
                    $confirmation = new Confirmation;
                    $confirmation->tanggal = $waktu_konfirmasi;
                    $confirmation->ponsel = $nomor_pengirim_balasan;
                    $confirmation->santri = $nama_santri_balasan;
                    $confirmation->kelas = $kelas_balasan;
                    $confirmation->jumlah = $jumlah_balasan;
                    $confirmation->tanggal_kirim = $tanggal_kirim_balasan;
                    $confirmation->pengirim = $nama_pengirim_balasan;
                    $confirmation->keperluan = $keperluan_kirim_balasan;
                    $confirmation->save();

                    // Hapus jika sudah dicek
                    Inbox::destroy($id);

                }

                /**
                 * Untuk keyword MASJID
                 */
                else if (strtoupper(@$pecah[0]) == 'MASJID' or strtoupper(@$pecah[0]) == 'MASJID ' or strtoupper(@$pecah[0]) == ' MASJID ')
                {

                    // Membaca data dari pecahan sms berdasarkan format
                    // masjid # nominal donasi # tanggal pengiriman # nama pemilik rekening pengirim # keterangan (jika ada)
                    $nomor_pengirim_balasan = $no_pengirim;
                    $nominal_donasi_balasan = str_replace("'", "\'", strtoupper(@$pecah[1]));
                    $tanggal_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[2]));
                    $nama_pemilik_rekening_balasan = str_replace("'", "\'", strtoupper(@$pecah[3]));
                    $keperluan_kirim_balasan = 'PEMBANGUNAN MASJID';
                    $keterangan_balasan = str_replace("'", "\'", strtoupper(@$pecah[4]));
                    
                    // SMS balasan
                    $isi_balasan = "Konfirmasi u/ jariyah masjid senilai $nominal_donasi_balasan oleh $nama_pemilik_rekening_balasan sudah kami terima. Terima kasih.";

                    $send = new SendController;
                    $send->send($nomor_pengirim_balasan, $isi_balasan);

                    // Salin data 
                    $confirmation = new Donation;
                    $confirmation->tanggal = $waktu_konfirmasi;
                    $confirmation->ponsel = $nomor_pengirim_balasan;
                    $confirmation->jumlah = $nominal_donasi_balasan;
                    $confirmation->tanggal_kirim = $tanggal_kirim_balasan;
                    $confirmation->pengirim = $nama_pemilik_rekening_balasan;
                    $confirmation->keperluan = $keperluan_kirim_balasan;
                    $confirmation->keterangan = $keterangan_balasan;
                    $confirmation->save();

                    // Hapus jika sudah dicek
                    Inbox::destroy($id);

                }

                /**
                 * Untuk keyword PSB
                 */
                else if (strtoupper(@$pecah[0]) == 'PSB' or strtoupper(@$pecah[0]) == 'PSB ' or strtoupper(@$pecah[0]) == ' PSB ')
                {

                    // Membaca data dari pecahan sms berdasarkan format
                    // psb # nama santri # no. pendaftaran # jumlah # tanggal kirim # nama pengirim # keperluan kirim
                    $nomor_pengirim_balasan = $no_pengirim;
                    $nama_santri_balasan = str_replace("'", "\'", strtoupper(@$pecah[1]));
                    $no_pendaftaran_balasan = str_replace("'", "\'", strtoupper(@$pecah[2]));
                    $jumlah_balasan = str_replace("'", "\'", strtoupper(@$pecah[3]));
                    $tanggal_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[4]));
                    $nama_pengirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[5]));
                    $keperluan_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[6]));

                    // SMS balasan
                    $isi_balasan = "Konfirmasi pngrman utk $nama_santri_balasan sejmlh $jumlah_balasan utk kprluan $keperluan_kirim_balasan akn sgr kmi proses.";

                    $send = new SendController;
                    $send->send($nomor_pengirim_balasan, $isi_balasan);

                    // Salin data 
                    $psb = new Psb;
                    $psb->tanggal = $waktu_konfirmasi;
                    $psb->ponsel = $nomor_pengirim_balasan;
                    $psb->santri = $nama_santri_balasan;
                    $psb->jenjang = 'D';
                    $psb->no_pendaftaran = $no_pendaftaran_balasan;
                    $psb->jumlah = $jumlah_balasan;
                    $psb->tanggal_kirim = $tanggal_kirim_balasan;
                    $psb->pengirim = $nama_pengirim_balasan;
                    $psb->keperluan = $keperluan_kirim_balasan;
                    $psb->save();

                    // Hapus jika sudah dicek
                    Inbox::destroy($id);

                }

                /**
                 * Untuk keyword QURBAN
                 */
                else if (strtoupper(@$pecah[0]) == 'QURBAN' or strtoupper(@$pecah[0]) == 'QURBAN ' or strtoupper(@$pecah[0]) == ' QURBAN ')
                {

                    // Membaca data dari pecahan sms berdasarkan format
                    // Qurban # nominal qurban # tanggal pengiriman # nama pemilik rekening pengirim # keterangan (jumlah dan hewan)
                    $nomor_pengirim_balasan = $no_pengirim;
                    $nominal_donasi_balasan = str_replace("'", "\'", strtoupper(@$pecah[1]));
                    $tanggal_kirim_balasan = str_replace("'", "\'", strtoupper(@$pecah[2]));
                    $nama_pemilik_rekening_balasan = str_replace("'", "\'", strtoupper(@$pecah[3]));
                    $keperluan_kirim_balasan = 'QURBAN';
                    $keterangan_balasan = str_replace("'", "\'", strtoupper(@$pecah[4]));

                    // SMS balasan
                    $isi_balasan = "Konfirmasi u/ qurban $nominal_donasi_balasan oleh $nama_pemilik_rekening_balasan sudah kami terima. Terima kasih.";

                    $send = new SendController;
                    $send->send($nomor_pengirim_balasan, $isi_balasan);

                    // Salin data 
                    $confirmation = new Donation;
                    $confirmation->tanggal = $waktu_konfirmasi;
                    $confirmation->ponsel = $nomor_pengirim_balasan;
                    $confirmation->jumlah = $nominal_donasi_balasan;
                    $confirmation->tanggal_kirim = $tanggal_kirim_balasan;
                    $confirmation->pengirim = $nama_pemilik_rekening_balasan;
                    $confirmation->keperluan = $keperluan_kirim_balasan;
                    $confirmation->keterangan = $keterangan_balasan;
                    $confirmation->save();

                    // Hapus jika sudah dicek
                    Inbox::destroy($id);

                }

                /**
                 * Untuk keyword yang TIDAK SESUAI
                 */
                else
                {

                    $nomor_pengirim_balasan = $no_pengirim;

                    // SMS balasan
                    // $isi_balasan = "Format SMS utk konfirmasi transfer: KONFIRMASI#nama santri#kelas#jumlah#tanggal kirim#nama pengirim#keperluan kirim. | Info lengkap, klik http://j.mp/frmtsms";
                    $isi_balasan = "Format SMS utk konfirmasi transfer: KONFIRMASI#nama santri#kelas#jumlah#tanggal kirim#nama pengirim#keperluan kirim. | Format lain, klik http://j.mp/frmtsms";

                    $send = new SendController;
                    $send->send($nomor_pengirim_balasan, $isi_balasan);

                    // Jadikan true untuk yang tidak sesuai format
                    Inbox::find($id)->update([
                        'Processed' => 'true'
                    ]);

                }
            }
            else
            {
                Inbox::find($id)->update([
                    'Processed' => 'true'
                ]);
            }

        }
    }
}
