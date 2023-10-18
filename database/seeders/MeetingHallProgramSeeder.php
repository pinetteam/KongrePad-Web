<?php

namespace Database\Seeders;

use App\Models\Meeting\Hall\Program\Program;
use Illuminate\Database\Seeder;

class MeetingHallProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::insert([
            [
                'hall_id' => '1',
                'sort_order' => '10',
                'code' => null,
                'title' => 'Uzmanına Danış: Vakalarla Meme Kanseri̇',
                'description' => null,
                'start_at' => '2023-11-01 13:30',
                'finish_at' => '2023-11-01 14:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '1',
                'sort_order' => '20',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-01 14:30',
                'finish_at' => '2023-11-01 14:45',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '1',
                'sort_order' => '30',
                'code' => null,
                'title' => 'Kurs: Jinekolojik Maligniteler',
                'description' => null,
                'start_at' => '2023-11-01 14:45',
                'finish_at' => '2023-11-01 17:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '2',
                'sort_order' => '40',
                'code' => null,
                'title' => 'Kurs: Tümör Agnostik Tedaviler',
                'description' => null,
                'start_at' => '2023-11-01 13:30',
                'finish_at' => '2023-11-01 15:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '2',
                'sort_order' => '50',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-01 15:30',
                'finish_at' => '2023-11-01 15:45',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '2',
                'sort_order' => '60',
                'code' => null,
                'title' => 'Onkolojide Az Konuşulanlar',
                'description' => null,
                'start_at' => '2023-11-01 15:45',
                'finish_at' => '2023-11-01 17:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '70',
                'code' => null,
                'title' => 'Açılış Konuşması',
                'description' => null,
                'start_at' => '2023-11-02 09:00',
                'finish_at' => '2023-11-02 09:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '80',
                'code' => 'panel-1',
                'title' => 'Panel 1: Gastrointestinal Sistem Kanserleri -1',
                'description' => null,
                'start_at' => '2023-11-02 09:15',
                'finish_at' => '2023-11-02 10:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '90',
                'code' => 'AstraZeneca-uydu-sempozyumu',
                'title' => 'AstraZeneca Uydu Sempozyumu',
                'description' => null,
                'start_at' => '2023-11-02 10:30',
                'finish_at' => '2023-11-02 11:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '110',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-02 11:00',
                'finish_at' => '2023-11-02 11:20',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '120',
                'code' => 'panel-2',
                'title' => 'Panel 2: Gastrointestinal Sistem Kanserleri -2',
                'description' => null,
                'start_at' => '2023-11-02 11:20',
                'finish_at' => '2023-11-02 12:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '130',
                'code' => null,
                'title' => 'Öğle Arası',
                'description' => null,
                'start_at' => '2023-11-02 12:15',
                'finish_at' => '2023-11-02 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '140',
                'code' => 'bristol-uydu-sempozyumu',
                'title' => 'Bristol Uydu Sempozyumu',
                'description' => null,
                'start_at' => '2023-11-02 13:30',
                'finish_at' => '2023-11-02 14:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],

            [
                'hall_id' => '3',
                'sort_order' => '150',
                'code' => 'panel-3',
                'title' => 'Panel 3: Endikasyon Dışı İlaç Kullanımında Mevcut Durum',
                'description' => null,
                'start_at' => '2023-11-02 14:00',
                'finish_at' => '2023-11-02 15:10',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '160',
                'code' => 'roche-uydu-sempozyumu',
                'title' => 'Roche Uydu Sempozyumu',
                'description' => 'Adjuvan KHDAK Tedavisinde Tecentriq ile Yaşama Erken Bir Dokunuş',
                'start_at' => '2023-11-02 15:10',
                'finish_at' => '2023-11-02 15:40',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '180',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-02 15:40',
                'finish_at' => '2023-11-02 16:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '190',
                'code' => 'debate',
                'title' => 'Debate: Rezektable Küçük Hücreli Dişi Akciğer Kanserinde Neoadjuvan vs. Adjuvan Tedavi',
                'description' => null,
                'start_at' => '2023-11-02 16:00',
                'finish_at' => '2023-11-02 17:00',
                'type' => 'debate',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '200',
                'code' => 'panel-4',
                'title' => 'Panel 4: Küçük Hücreli Dışı Akciğer Kanseri',
                'description' => null,
                'start_at' => '2023-11-03 09:15',
                'finish_at' => '2023-11-03 10:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '210',
                'code' => 'msd-uydu-sempozyumu',
                'title' => 'MSD Uydu Sempozyumu',
                'description' => '1L NSCLC KN-189, 407 Çalışmalarının 5 Yıl Sonuçları',
                'start_at' => '2023-11-03 10:30',
                'finish_at' => '2023-11-03 11:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '230',
                'code' => 'kahve-molası',
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-03 11:00',
                'finish_at' => '2023-11-03 11:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '240',
                'code' => 'panel-5',
                'title' => 'Panel 5: Erken Evre Meme Kanseri̇',
                'description' => null,
                'start_at' => '2023-11-03 11:15',
                'finish_at' => '2023-11-03 12:05',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '250',
                'code' => 'novartis-uydu-sempozyumu',
                'title' => 'Novartis Uydu Sempozyumu',
                'description' => null,
                'start_at' => '2023-11-03 12:05',
                'finish_at' => '2023-11-03 12:35',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '260',
                'code' => null,
                'title' => 'Öğle Arası',
                'description' => null,
                'start_at' => '2023-11-03 12:35',
                'finish_at' => '2023-11-03 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '270',
                'code' => 'panel-6',
                'title' => 'Panel 6: İleri̇ Evre Meme Kanseri',
                'description' => null,
                'start_at' => '2023-11-03 13:30',
                'finish_at' => '2023-11-03 14:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '280',
                'code' => 'gilead-uydu-sempozyumu',
                'title' => 'Gilead Uydu Sempozyumu',
                'description' => null,
                'start_at' => '2023-11-03 14:30',
                'finish_at' => '2023-11-03 15:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '290',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-03 15:00',
                'finish_at' => '2023-11-03 15:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '300',
                'code' => 'pfizer-uydu-sempozyumu',
                'title' => 'Pfizer Uydu Sempozyumu',
                'description' => 'CROWN ışığında Lorviqua: ALK+ mKHDAK 1. Basamak Tedavisinde Güncel Gelişmeler',
                'start_at' => '2023-11-03 15:15',
                'finish_at' => '2023-11-03 15:45',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '310',
                'code' => 'panel-7',
                'title' => 'Panel 7: Melanom',
                'description' => null,
                'start_at' => '2023-11-03 15:45',
                'finish_at' => '2023-11-03 16:40',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '320',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-03 16:40',
                'finish_at' => '2023-11-03 17:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '330',
                'code' => null,
                'title' => 'Debate: Yapay Zeka Gelecektir vs. Tehdittir',
                'description' => null,
                'start_at' => '2023-11-03 17:00',
                'finish_at' => '2023-11-03 18:00',
                'type' => 'debate',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '340',
                'code' => 'merck-uydu-sempozyumu',
                'title' => 'Merck Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor',
                'start_at' => '2023-11-03 11:00',
                'finish_at' => '2023-11-03 11:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '350',
                'code' => 'merck-uydu-sempozyumu',
                'title' => 'Merck Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor',
                'start_at' => '2023-11-03 13:00',
                'finish_at' => '2023-11-03 13:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '360',
                'code' => 'merck-uydu-sempozyumu',
                'title' => 'Merck Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor',
                'start_at' => '2023-11-03 15:00',
                'finish_at' => '2023-11-03 15:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '370',
                'code' => 'panel-8',
                'title' => 'Panel 8: Genitoüriner Kanserler',
                'description' => null,
                'start_at' => '2023-11-04 09:15',
                'finish_at' => '2023-11-04 11:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '380',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-04 11:00',
                'finish_at' => '2023-11-04 11:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '390',
                'code' => 'astellas-uydu-sempozyumu',
                'title' => 'Astellas Uydu Sempozyumu',
                'description' => 'Prostat Kanseri Tedavisinde Önce XTANDI',
                'start_at' => '2023-11-04 11:15',
                'finish_at' => '2023-11-04 11:45',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '400',
                'code' => 'panel-9',
                'title' => 'Panel 9: Jinekolojik Tümörler',
                'description' => null,
                'start_at' => '2023-11-04 11:45',
                'finish_at' => '2023-11-04 12:35',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '410',
                'code' => null,
                'title' => 'Öğle Arası',
                'description' => null,
                'start_at' => '2023-11-04 12:35',
                'finish_at' => '2023-11-04 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '420',
                'code' => 'gsk-uydu-sempozyumu',
                'title' => 'GSK Uydu Sempozyumu',
                'description' => 'Over Kanseri İdame Tedavisinde Zejula ile Yeni Bir Dönem',
                'start_at' => '2023-11-04 13:30',
                'finish_at' => '2023-11-04 14:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '410',
                'code' => 'panel-10',
                'title' => 'Panel 10',
                'description' => null,
                'start_at' => '2023-11-04 14:00',
                'finish_at' => '2023-11-04 15:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '450',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'start_at' => '2023-11-04 15:15',
                'finish_at' => '2023-11-04 15:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '460',
                'code' => 'msd-uydu-sempozyumu',
                'title' => 'MSD Uydu Sempozyumu',
                'description' => 'Erken Evre TNBC Tedavisinde Pembrolizumab',
                'start_at' => '2023-11-04 15:30',
                'finish_at' => '2023-11-04 16:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '470',
                'code' => 'panel-11',
                'title' => 'Panel 11: Seçilmiş Sözel Bildiriler',
                'description' => null,
                'start_at' => '2023-11-04 16:00',
                'finish_at' => '2023-11-04 16:45',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '480',
                'code' => null,
                'title' => 'Soru & Cevap & Tartışma',
                'description' => null,
                'start_at' => '2023-11-04 16:45',
                'finish_at' => '2023-11-04 17:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '490',
                'code' => null,
                'title' => 'Kapanış',
                'description' => null,
                'start_at' => '2023-11-04 17:00',
                'finish_at' => '2023-11-04 17:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '500',
                'code' => 'panel-12',
                'title' => 'Panel 12: Palyatif Tedaviler',
                'description' => null,
                'start_at' => '2023-11-05 09:30',
                'finish_at' => '2023-11-05 11:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '510',
                'code' => null,
                'title' => 'Kapanış',
                'description' => null,
                'start_at' => '2023-11-05 11:30',
                'finish_at' => '2023-11-05 12:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '4',
                'sort_order' => '520',
                'code' => null,
                'title' => 'Sözel Bildiriler – I',
                'description' => 'Tartışmacı: Tülay Eren, Osman Köstek, Hacer Demir',
                'start_at' => '2023-11-02 10:30',
                'finish_at' => '2023-11-02 12:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '4',
                'sort_order' => '530',
                'code' => null,
                'title' => 'Sözel Bildiriler – II',
                'description' => 'Tartışmacı: Seher Nazlı Kazaz, İbrahim Karadağ, Metin Demir',
                'start_at' => '2023-11-02 13:30',
                'finish_at' => '2023-11-02 15:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '4',
                'sort_order' => '540',
                'code' => null,
                'title' => 'Sözel Bildiriler – III',
                'description' => 'Tartışmacı: Nadire Küçüköztaş, İrem Bilgetekin, Okan Avcı',
                'start_at' => '2023-11-03 10:30',
                'finish_at' => '2023-11-03 12:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '4',
                'sort_order' => '550',
                'code' => null,
                'title' => 'Sözel Bildiriler – IV',
                'description' => 'Tartışmacı: Hatice Yılmaz, Murat Sarı, Cengiz Akosman',
                'start_at' => '2023-11-03 13:30',
                'finish_at' => '2023-11-03 15:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '4',
                'sort_order' => '560',
                'code' => null,
                'title' => 'Sözel Bildiriler – V',
                'description' => 'Tartışmacı: Emre Yekedüz, Semiha Urvay, Aydın Aytekin',
                'start_at' => '2023-11-04 10:30',
                'finish_at' => '2023-11-04 12:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
        ]);
    }
}
