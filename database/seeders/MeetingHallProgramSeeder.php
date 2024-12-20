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
                'title' => 'Uzmanına Danış: Vakalarla Meme Kanseri',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'description' => 'Konuşmacı: Başak Oyan Uluç',
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 09:15',
                'finish_at' => '2023-11-02 10:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '90',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Over ve Meme Kanserlerinde LYNPARZA Tedavisi'."\n\n".'Moderatör: Nilüfer Güler',
                'logo_name' => '1a4e43f9-ac49-4dfe-942a-9303666530f3',
                'logo_extension' => 'png',
                'start_at' => '2023-11-02 10:30',
                'finish_at' => '2023-11-02 11:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '100',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 11:00',
                'finish_at' => '2023-11-02 11:20',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '110',
                'code' => 'panel-2',
                'title' => 'Panel 2: Gastrointestinal Sistem Kanserleri -2',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 11:20',
                'finish_at' => '2023-11-02 12:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '120',
                'code' => null,
                'title' => 'Öğle Arası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 12:15',
                'finish_at' => '2023-11-02 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '130',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => '1. Basamak mKHDAK Tedavisinde Klinik Verilerle CM 9LA ve Opdivo+Yervoy+2 Kür KT Deneyimi'."\n\n".'Moderatör: Gökhan Demir',
                'logo_name' => 'cb4911cf-bac3-4e36-a36c-5c23ec547036',
                'logo_extension' => 'png',
                'start_at' => '2023-11-02 13:30',
                'finish_at' => '2023-11-02 14:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '140',
                'code' => 'panel-3',
                'title' => 'Panel 3: Endikasyon Dışı İlaç Kullanımında Mevcut Durum',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 14:00',
                'finish_at' => '2023-11-02 15:10',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '150',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Adjuvan KHDAK Tedavisinde Tecentriq ile Yaşama Erken Bir Dokunuş'."\n\n".'Moderatör: Ahmet Bilici',
                'logo_name' => '2e9fba1d-6dd8-4f76-84eb-73095475362f',
                'logo_extension' => 'png',
                'start_at' => '2023-11-02 15:10',
                'finish_at' => '2023-11-02 15:40',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '160',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 15:40',
                'finish_at' => '2023-11-02 16:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '170',
                'code' => 'debate',
                'title' => 'Debate',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-02 16:00',
                'finish_at' => '2023-11-02 17:00',
                'type' => 'debate',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '180',
                'code' => 'panel-4',
                'title' => 'Panel 4: Küçük Hücreli Dışı Akciğer Kanseri',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 09:15',
                'finish_at' => '2023-11-03 10:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '210',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => '1.Basamak mKHDAK Tedavisinde Keytruda Deneyimleri',
                'logo_name' => '24761c63-163b-4a3c-b633-9338049b4b35',
                'logo_extension' => 'png',
                'start_at' => '2023-11-03 10:30',
                'finish_at' => '2023-11-03 11:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '220',
                'code' => 'kahve-molası',
                'title' => 'Kahve Molası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 11:00',
                'finish_at' => '2023-11-03 11:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '230',
                'code' => 'panel-5',
                'title' => 'Panel 5: Erken Evre Meme Kanseri̇',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 11:15',
                'finish_at' => '2023-11-03 12:05',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '240',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'HR(+) HER2(-) Metastatik Meme Kanserinde Yaşam için VALAMOR'."\n\n".'Moderatör: Nil Molinas Mandel',
                'logo_name' => 'cff50211-45f1-45ea-877e-bbbbb9126b04',
                'logo_extension' => 'png',
                'start_at' => '2023-11-03 12:05',
                'finish_at' => '2023-11-03 12:35',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '250',
                'code' => null,
                'title' => 'Öğle Arası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 12:35',
                'finish_at' => '2023-11-03 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '260',
                'code' => 'panel-6',
                'title' => 'Panel 6: İleri Evre Meme Kanseri',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 13:30',
                'finish_at' => '2023-11-03 14:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '270',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Metastatik Üçlü Negatif Meme Kanserinde Standartları Yükseltiyoruz'."\n\n".'Moderatör: Yeşim Eralp',
                'logo_name' => 'fc649435-8cc8-4385-8b3e-4dc9d0ea1b70',
                'logo_extension' => 'png',
                'start_at' => '2023-11-03 14:30',
                'finish_at' => '2023-11-03 15:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '280',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 15:00',
                'finish_at' => '2023-11-03 15:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '290',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'CROWN ışığında Lorviqua: ALK+ mKHDAK 1. Basamak Tedavisinde Güncel Gelişmeler'."\n\n".'Moderatör: Mustafa Erman',
                'logo_name' => 'eb2e2111-130f-4b87-b713-e0b0b9410719',
                'logo_extension' => 'png',
                'start_at' => '2023-11-03 15:15',
                'finish_at' => '2023-11-03 15:45',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '300',
                'code' => 'panel-7',
                'title' => 'Panel 7: Melanom',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 15:45',
                'finish_at' => '2023-11-03 16:40',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '310',
                'code' => null,
                'title' => 'Kahve Molası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 16:40',
                'finish_at' => '2023-11-03 17:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '320',
                'code' => null,
                'title' => 'Debate',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-03 17:00',
                'finish_at' => '2023-11-03 18:00',
                'type' => 'debate',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '340',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor'."\n\n".'Konuşmacı: Mert Başaran',
                'logo_name' => '44706e3c-1038-465b-9a00-4bc1bda5c0e4',
                'logo_extension' => 'png',
                'start_at' => '2023-11-03 11:00',
                'finish_at' => '2023-11-03 11:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '350',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor'."\n\n".'Konuşmacı: Mehmet Ali Nahit Şendur',
                'logo_name' => '44706e3c-1038-465b-9a00-4bc1bda5c0e4',        'logo_extension' => 'png',
                'start_at' => '2023-11-03 13:00',
                'finish_at' => '2023-11-03 13:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'sort_order' => '360',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Mesane Kanseri Tedavisi BAVENCIO® İle Yeniden Şekilleniyor'."\n\n".'Konuşmacı: Çağatay Arslan',
                'logo_name' => '44706e3c-1038-465b-9a00-4bc1bda5c0e4',        'logo_extension' => 'png',
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-04 11:00',
                'finish_at' => '2023-11-04 11:15',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '390',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Prostat Kanseri Tedavisinde Önce XTANDI'."\n\n".'Moderatör: Mehmet Artaç',
                'logo_name' => '8d38b0d2-7593-4c3a-9e20-f8c454e21692',
                'logo_extension' => 'png',
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-04 12:35',
                'finish_at' => '2023-11-04 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '420',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Over Kanseri İdame Tedavisinde Zejula ile Yeni Bir Dönem'."\n\n".'Oturum Başkanı: Erdem Göker',
                'logo_name' => 'a4b9c4de-ebf2-4586-9798-036a74bea950',
                'logo_extension' => 'png',
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-04 15:15',
                'finish_at' => '2023-11-04 15:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '3',
                'sort_order' => '460',
                'code' => 'uydu-sempozyumu',
                'title' => 'Uydu Sempozyumu',
                'description' => 'Erken Evre TNBC Tedavisinde Pembrolizumab',
                'logo_name' => '37864d80-a79a-4a74-ab90-8cb89c010605',
                'logo_extension' => 'png',
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'logo_name' => null,
                'logo_extension' => null,
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
                'description' => 'Tartışmacı: Fatih Karataş, Semiha Urvay, Aydın Aytekin',
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-11-04 10:30',
                'finish_at' => '2023-11-04 12:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '10',
                'code' => null,
                'title' => 'Oturum 1: Meme Kanseri',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-16 10:00',
                'finish_at' => '2023-12-16 12:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '20',
                'code' => null,
                'title' => 'Öğle Yemeği',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-16 12:00',
                'finish_at' => '2023-12-16 13:30',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '30',
                'code' => null,
                'title' => 'Oturum 2: Akciğer Kanseri',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-16 13:30',
                'finish_at' => '2023-12-16 15:30',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '40',
                'code' => null,
                'title' => 'Kahve arası',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-16 15:30',
                'finish_at' => '2023-12-16 16:00',
                'type' => 'other',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '50',
                'code' => null,
                'title' => 'Oturum 3: Melanom',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-16 16:00',
                'finish_at' => '2023-12-16 18:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '60',
                'code' => null,
                'title' => 'Oturum 4: Genitoüriner Kanserler',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-17 10:00',
                'finish_at' => '2023-12-17 12:00',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '70',
                'code' => null,
                'title' => 'Akılcı İlaç Sunumu',
                'description' => 'Konuşmacı: Gökhan Çelenkoğlu',
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-17 12:00',
                'finish_at' => '2023-12-17 12:15',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
            [
                'hall_id' => '6',
                'sort_order' => '80',
                'code' => null,
                'title' => 'Değerlendirme ve Kapanış',
                'description' => null,
                'logo_name' => null,
                'logo_extension' => null,
                'start_at' => '2023-12-17 12:15',
                'finish_at' => '2023-12-17 12:25',
                'type' => 'session',
                'is_started' => '0',
                'status' => 1,
            ],
        ]);
    }
}
