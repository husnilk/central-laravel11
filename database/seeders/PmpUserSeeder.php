<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PmpUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $faker = Faker::create('id_ID');
        $users = [
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Prof. Ir. Surya Afnarius, PhD',
                'email' => 'surya@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Husnil Kamil, M.T',
                'email' => 'husnilk@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Hasdi Putra, M.T',
                'email' => 'hasdiputra@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Ricky Akbar, M. Kom',
                'email' => 'ricky@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Fajril Akbar, M.Sc',
                'email' => 'ijab@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Haris Suryamen, M.Sc',
                'email' => 'haris.suryamen@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Jefril Rahmadoni, M.Kom',
                'email' => 'jefrilrahmadoni@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Adi Arga Afrinur, M.Kom',
                'email' => 'adiargaafrinur@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Afriyanti Dwi Kartika, M.T',
                'email' => 'afriyantidwikartika@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Dwi Welly Sukma Nirad, M.T',
                'email' => 'dwiwellysukmanirad@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Hafizah Hanim, M.Kom',
                'email' => 'hafizahhanim@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Ullya Mega Wahyuni, M.Kom',
                'email' => 'ullyamegawahyuni@it.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Rahmatika Pratama Santi, M.T',
                'email' => 'rahmatikaps@fti.unand.ac.id',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Febby Apri Wenando, M.Eng',
                'email' => 'dummy@example.com',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
            [
                'username' => $faker->numerify('L####'),
                'name' => 'Aina Hubby Aziira, M.Eng',
                'email' => 'dummy2@example.com',
                'password' => Hash::make('12345678'),
                'type' => User::LECTURER,
                'active' => 1,
            ],
        ];

        foreach ($users as $user) {
            $newUser = User::create($user);
            $lecturer = Lecturer::factory()->create([
                'id' => $newUser->id,
                'name' => $user['name'],
            ]);
        }
        $students = [
            ['nim' => 2011521001, 'name' => 'TAUFIK HIDAYAT'],
            ['nim' => 2011521002, 'name' => 'BAITUL AZIZAH'],
            ['nim' => 2011521003, 'name' => 'DINA LATHIFUNNISA . A'],
            ['nim' => 2011521004, 'name' => 'NADILLA SARASWATI'],
            ['nim' => 2011521005, 'name' => 'ANNISA FARAS'],
            ['nim' => 2011521006, 'name' => 'REYSHA IRSYALINA'],
            ['nim' => 2011521007, 'name' => 'RADITHYA ROMERO AL GIFFARY'],
            ['nim' => 2011521008, 'name' => 'DESRILIA PUTRI UTAMI'],
            ['nim' => 2011521009, 'name' => 'RISKA SHIFA SALSABILLA'],
            ['nim' => 2011521010, 'name' => 'DEAN FISABIL ANDWI'],
            ['nim' => 2011521011, 'name' => 'FADILA TRI AFRIANI'],
            ['nim' => 2011521012, 'name' => 'LARA BUSYANIL'],
            ['nim' => 2011521013, 'name' => 'PUTI JUGALO'],
            ['nim' => 2011521014, 'name' => 'THOMAS AKRAM FERDINAN'],
            ['nim' => 2011521015, 'name' => 'HAGI SIRAJ SUMANTA'],
            ['nim' => 2011521016, 'name' => 'SEFZA AUMA TIANG ALAM'],
            ['nim' => 2011521017, 'name' => 'IQBAL FITRAHUL RAMADHAN'],
            ['nim' => 2011521018, 'name' => 'SITI NUR AISAH'],
            ['nim' => 2011521019, 'name' => 'DAENG FEBRINO'],
            ['nim' => 2011521020, 'name' => 'PAWAL ATAKOSI'],
            ['nim' => 2011521021, 'name' => 'AULIA DWI SHAVIQA POHAN'],
            ['nim' => 2011521022, 'name' => 'SEKAR RAYHANNISA'],
            ['nim' => 2011521023, 'name' => 'HANIF IZZA PRATAMA'],
            ['nim' => 2011521024, 'name' => 'HARRIKO NUR HARZEKI'],
            ['nim' => 2011521025, 'name' => 'NADA SAFARINA'],
            ['nim' => 2011521026, 'name' => 'AKMAL RAFI NURSYABANI'],
            ['nim' => 2011521027, 'name' => 'PUTRI WULAN DARI'],
            ['nim' => 2011522001, 'name' => 'DZUL FAUZI'],
            ['nim' => 2011522002, 'name' => 'SALMA'],
            ['nim' => 2011522005, 'name' => 'LUTHFIA HUMAIRA'],
            ['nim' => 2011522006, 'name' => 'RAIDHA QATRUNNADA'],
            ['nim' => 2011522007, 'name' => 'IQBAL MANAZIL YUNI'],
            ['nim' => 2011522008, 'name' => 'FAIZ ABDULLAH'],
            ['nim' => 2011522009, 'name' => 'ALIA NURHIKMAH'],
            ['nim' => 2011522010, 'name' => 'TRI AYUNIA PATMA LUBIS'],
            ['nim' => 2011522011, 'name' => 'DWISUCI INSANI KARIMAH'],
            ['nim' => 2011522012, 'name' => 'RAHMADINA'],
            ['nim' => 2011522013, 'name' => 'JAHRO SUROYA TAURIN'],
            ['nim' => 2011522014, 'name' => 'ANANDA FITRIA'],
            ['nim' => 2011522015, 'name' => 'ANNISA ULFA'],
            ['nim' => 2011522016, 'name' => 'WINANDA AFRILIA HARISYA'],
            ['nim' => 2011522017, 'name' => 'VALLEN ADITHYA REKHSANA'],
            ['nim' => 2011522018, 'name' => 'RUTH EMERALDA RAIHAN'],
            ['nim' => 2011522019, 'name' => 'ILHAM'],
            ['nim' => 2011522020, 'name' => 'MUHAMMAD ZAIM MILZAM'],
            ['nim' => 2011522021, 'name' => 'MUHAMMAD RAYHAN RIZALDI'],
            ['nim' => 2011522022, 'name' => 'MUHAMMAD FARHAN ANANDA MIRZAH'],
            ['nim' => 2011522023, 'name' => 'BOBY DARMAWAN'],
            ['nim' => 2011522024, 'name' => 'ALIF ABDUL RAUF'],
            ['nim' => 2011522025, 'name' => 'AINI IZZATHY ISPENDI'],
            ['nim' => 2011522026, 'name' => 'SRI ULFA BERLIANI'],
            ['nim' => 2011522027, 'name' => 'DELICIA SYIFA MAGHFIRA'],
            ['nim' => 2011522028, 'name' => 'MUHAMMAD HAFIZ AULIA RAHMADONI'],
            ['nim' => 2011522029, 'name' => 'KHALIL AMIR'],
            ['nim' => 2011522030, 'name' => 'MUHAMMAD AFIF'],
            ['nim' => 2011522032, 'name' => 'DEYOLA FADWA SHIFANA'],
            ['nim' => 2011523001, 'name' => 'SALSABILA RAMADHANI PUTRI'],
            ['nim' => 2011523002, 'name' => 'FATHIH MUHAMMAD ALFI'],
            ['nim' => 2011523003, 'name' => 'MUHAMMAD YUDHISTIRA'],
            ['nim' => 2011523004, 'name' => 'LATHIF NUR IRSYAD'],
            ['nim' => 2011523005, 'name' => 'FARRAS NAUFAL SUHANDA'],
            ['nim' => 2011523006, 'name' => 'HILMI SALSABILLA'],
            ['nim' => 2011523007, 'name' => 'RAIDAN MALIK SANDRA'],
            ['nim' => 2011523008, 'name' => 'ARBIYAN REALSON'],
            ['nim' => 2011523009, 'name' => 'NATHANIARAHAYU'],
            ['nim' => 2011523010, 'name' => 'FARADILA SUWANDI'],
            ['nim' => 2011523011, 'name' => 'GITA PUTRI'],
            ['nim' => 2011523012, 'name' => 'ZUHA BIMA AL FARUQ'],
            ['nim' => 2011523013, 'name' => 'SHEFILLA RAISYA RAZADE STEVANO'],
            ['nim' => 2011523014, 'name' => 'MUHAMMAD ERLANGGA ADI NUGRAHA'],
            ['nim' => 2011523015, 'name' => 'MUHAMMAD REZA RIZKI RAHMADI'],
            ['nim' => 2011523016, 'name' => 'DARIBSAN'],
            ['nim' => 2011523019, 'name' => 'KEMAL MUHAMMAD HIERO'],
            ['nim' => 2011523021, 'name' => 'FIKRI NAZIF KHAIRUNNAS'],
            ['nim' => 2011527001, 'name' => 'DAFFA RIZA MULIYA'],
            ['nim' => 2011527002, 'name' => 'RIZKI JUNI DARMAWAN'],
            ['nim' => 2111521001, 'name' => 'DAFFA ABDILLAH'],
            ['nim' => 2111521002, 'name' => 'WINDA ADELIA'],
            ['nim' => 2111521003, 'name' => 'BIMBI SANTRIADI'],
            ['nim' => 2111521004, 'name' => 'LUTFIA AULIA'],
            ['nim' => 2111521005, 'name' => 'SHABRINA ELFANI GUCY'],
            ['nim' => 2111521006, 'name' => 'MUTIARA MAHARANI'],
            ['nim' => 2111521007, 'name' => 'NADIA NUR SAIDA'],
            ['nim' => 2111521008, 'name' => 'SEPTIA AMANDA'],
            ['nim' => 2111521009, 'name' => 'AZZAHRA ATHIFAH DZAKI'],
            ['nim' => 2111521010, 'name' => 'SALSABILA RAHMAH'],
            ['nim' => 2111521011, 'name' => 'SYADZA INTAN BENYA'],
            ['nim' => 2111521012, 'name' => 'DINI ARISANDI'],
            ['nim' => 2111521013, 'name' => 'FAYZA ZEEVANIA PUTRI'],
            ['nim' => 2111521014, 'name' => 'IQBAL FIRMANSYAH'],
            ['nim' => 2111521015, 'name' => 'MUHAMMAD IRSYADUL FIKRI'],
            ['nim' => 2111521017, 'name' => 'AL-AMIN'],
            ['nim' => 2111521019, 'name' => 'THOMAS NOBEL ASFAR'],
            ['nim' => 2111521020, 'name' => 'FINA AULIA NAZARI'],
            ['nim' => 2111521022, 'name' => 'CITRA AULIA'],
            ['nim' => 2111521023, 'name' => 'DARMA ZIDANE GUSNAMBI'],
            ['nim' => 2111521024, 'name' => 'FIKRAN SHADIQ EL YAFIT'],
            ['nim' => 2111521025, 'name' => 'ARIESKA KHARZANI'],
            ['nim' => 2111522001, 'name' => 'NIKI YULIA NADA'],
            ['nim' => 2111522002, 'name' => 'GILANG KHARISMA'],
            ['nim' => 2111522003, 'name' => 'RAFIQATUL ULYA'],
            ['nim' => 2111522005, 'name' => 'RAKHILCA YANEDIKA'],
            ['nim' => 2111522006, 'name' => 'ARIQ ABDURRAHMAN HAKIM'],
            ['nim' => 2111522007, 'name' => 'AHMAD ALI ZULFIQAR MAJID'],
            ['nim' => 2111522008, 'name' => 'MUHAMMAD SATRIA GEMILANG LUBIS'],
            ['nim' => 2111522009, 'name' => 'YOHANDA'],
            ['nim' => 2111522010, 'name' => 'ATHIFA RIFDA ANDRA'],
            ['nim' => 2111522011, 'name' => 'ANNISA GITA SUBHI'],
            ['nim' => 2111522012, 'name' => 'ANNISA HASIFAH CANTIKA'],
            ['nim' => 2111522013, 'name' => 'NURUL INSAN'],
            ['nim' => 2111522014, 'name' => 'SUCI RAHMADHANI'],
            ['nim' => 2111522015, 'name' => 'MUHAMMAD DZAKY DINNUL HAQ'],
            ['nim' => 2111522016, 'name' => 'ALVINO ALBAS'],
            ['nim' => 2111522017, 'name' => 'SYAKINA TRIYANA'],
            ['nim' => 2111522018, 'name' => 'PUTRA ILHAM'],
            ['nim' => 2111522019, 'name' => 'KARIN OKTARIANI E'],
            ['nim' => 2111522020, 'name' => 'SYAHNIA PUTRI HENDRY'],
            ['nim' => 2111522021, 'name' => 'NADINI ANNISA BYANT'],
            ['nim' => 2111522024, 'name' => 'BRIANA FIRSTA'],
            ['nim' => 2111522026, 'name' => 'DIQZI APRIALDI'],
            ['nim' => 2111522027, 'name' => 'MUHAMMAD REZKY RAMADHAN'],
            ['nim' => 2111522030, 'name' => 'HUSNA AFIQAH YOSSYAFRA'],
            ['nim' => 2111522031, 'name' => 'KHAIRUNNISA SALSABILA'],
            ['nim' => 2111523001, 'name' => 'LUTFI MAULANA'],
            ['nim' => 2111523002, 'name' => 'NABILA FITRI MISYANDRA'],
            ['nim' => 2111523003, 'name' => 'VANIA ZERLINA UTAMI'],
            ['nim' => 2111523006, 'name' => 'FAHRI ANDIKA SANJAYA'],
            ['nim' => 2111523007, 'name' => 'MUHAMMAD IKHLAS'],
            ['nim' => 2111523009, 'name' => 'AHMAD RIFKI FARID'],
            ['nim' => 2111523010, 'name' => 'MHD.FAIZ YUNUS'],
            ['nim' => 2111523012, 'name' => 'RASYID NUGRAHESA RIQUA'],
            ['nim' => 2111523013, 'name' => 'SYAFIRA PUTRI ZAHRA'],
            ['nim' => 2111523014, 'name' => 'NURUL SYIFA UTAMI'],
            ['nim' => 2111523015, 'name' => 'GHINA FITRI HIDAYAH'],
            ['nim' => 2111523016, 'name' => 'ALDO AGUSTIO'],
            ['nim' => 2111523018, 'name' => 'ARIF WAHYUDI'],
            ['nim' => 2111523020, 'name' => 'DIO APRI DANDI'],
            ['nim' => 2111523021, 'name' => 'HASYA ZIKRA ALFRENA'],
            ['nim' => 2111523022, 'name' => 'REVI PUTRA HERNEL'],
            ['nim' => 2111523023, 'name' => 'RIZQI FARIDSYAH NAJIB ADIVITA'],
            ['nim' => 2111523024, 'name' => 'KHAIRIN NISA'],
            ['nim' => 2111527001, 'name' => 'SUKMA ANGGARMADI'],
            ['nim' => 2111527002, 'name' => 'IRFAN WAHENDRA'],
            ['nim' => 2111527003, 'name' => 'MAHAPUTRI CLAUDIA FERNANDO'],
            //            ['nim' => 2211521001, 'name' => 'RAHMA AURELIA ZAMI'],
            //            ['nim' => 2211521002, 'name' => 'NAJLA HUMAIRA DESNI'],
            //            ['nim' => 2211521003, 'name' => 'MHD. ULIL ABSHAR'],
            //            ['nim' => 2211521004, 'name' => 'NADIA DEARI HANIFAH'],
            //            ['nim' => 2211521005, 'name' => 'MUHAMMAD HARSYA'],
            //            ['nim' => 2211521006, 'name' => 'NAJLA NADIVA'],
            //            ['nim' => 2211521007, 'name' => 'ANNISA NURUL HAKIM'],
            //            ['nim' => 2211521008, 'name' => 'NAUFAL ADLI DHIAURRAHMAN'],
            //            ['nim' => 2211521009, 'name' => 'MIFTAHUL KHAIRA'],
            //            ['nim' => 2211521010, 'name' => 'DHIYA GUSTITA AQILA'],
            //            ['nim' => 2211521011, 'name' => 'LUTHFIA NURUL IZZA'],
            //            ['nim' => 2211521012, 'name' => 'RIZKA KURNIA ILLAHI'],
            //            ['nim' => 2211521013, 'name' => 'MEYDIVA INTAYEZA'],
            //            ['nim' => 2211521014, 'name' => 'IZZA TRY MALINDA'],
            //            ['nim' => 2211521015, 'name' => 'NURUL AFANI'],
            //            ['nim' => 2211521017, 'name' => 'GHINA ANFASHA NURHADI'],
            //            ['nim' => 2211521018, 'name' => 'ZIGGY YAFI HISYAM'],
            //            ['nim' => 2211521019, 'name' => 'UMAR ABDULLAH AZZAM'],
            //            ['nim' => 2211521020, 'name' => 'MUHAMMAD NOUVAL HABIBIE'],
            //            ['nim' => 2211522001, 'name' => 'CIKAL VIRGIA FAHRENZI'],
            //            ['nim' => 2211522002, 'name' => 'EFRIYENDI'],
            //            ['nim' => 2211522003, 'name' => 'FRIZQYA DELA PRATIWI'],
            //            ['nim' => 2211522004, 'name' => 'MUHAMMAD FARHAN'],
            //            ['nim' => 2211522005, 'name' => 'RADIATUL MUTMAINNAH'],
            //            ['nim' => 2211522006, 'name' => 'RUCHIL AMELINDA'],
            //            ['nim' => 2211522007, 'name' => 'TIARA WAHYUNI'],
            //            ['nim' => 2211522008, 'name' => 'TRIANA ZAHARA NURHALIZA'],
            //            ['nim' => 2211522009, 'name' => 'RAMADHANI SAFITRI'],
            //            ['nim' => 2211522010, 'name' => 'FADLI HIDAYAT'],
            //            ['nim' => 2211522011, 'name' => 'GHIFARI RIZKI RAMADHAN'],
            //            ['nim' => 2211522012, 'name' => 'HATTA ASRI RAHMAN'],
            //            ['nim' => 2211522013, 'name' => 'BENNI PUTRA CHANIAGO'],
            //            ['nim' => 2211522014, 'name' => 'RENDI KURNIAWAN'],
            //            ['nim' => 2211522015, 'name' => 'OKTAVIANI ANDRIANTI'],
            //            ['nim' => 2211522016, 'name' => 'VIONI WIJAYA PUTRI'],
            //            ['nim' => 2211522017, 'name' => 'ZELFITRIO RODESKI'],
            //            ['nim' => 2211522018, 'name' => 'NABIL RIZKI NAVISA'],
            //            ['nim' => 2211522019, 'name' => 'ANGELI PUTRI RAMADHANI'],
            //            ['nim' => 2211522020, 'name' => 'NAUFAL'],
            //            ['nim' => 2211522021, 'name' => 'RIFQI ASVERIAN PUTRA'],
            //            ['nim' => 2211522022, 'name' => 'AZIZAH NOVI DELFIANTI'],
            //            ['nim' => 2211522023, 'name' => 'TALITHA ZULFA AMIRAH'],
            //            ['nim' => 2211522024, 'name' => 'MIFTAHUL JANAH'],
            //            ['nim' => 2211522025, 'name' => 'CHELVIERY ANGGORO'],
            //            ['nim' => 2211522026, 'name' => 'MUHAMMAD ALFA RIAN'],
            //            ['nim' => 2211522027, 'name' => 'AQIMA ADALAHITA'],
            //            ['nim' => 2211522028, 'name' => 'ILHAM NOFALDI'],
            //            ['nim' => 2211522029, 'name' => 'ARI RAIHAN DAFA'],
            //            ['nim' => 2211522030, 'name' => 'ISRA RAHMA DINA'],
            //            ['nim' => 2211522031, 'name' => 'MUHAMMAD RAIHAN ALGHIFARI'],
            //            ['nim' => 2211522032, 'name' => 'AHMAD HILMI FAHREZI'],
            //            ['nim' => 2211522033, 'name' => 'RISYDA AZIFATIL MAGHFIRA'],
            //            ['nim' => 2211522034, 'name' => 'ANASTASYA ESTU WAHYUDI'],
            //            ['nim' => 2211522035, 'name' => 'AKRAM MAKRUF AIDIL'],
            //            ['nim' => 2211522036, 'name' => 'MUSTAFA FATHUR RAHMAN'],
            //            ['nim' => 2211522037, 'name' => 'MUHAMMAD DANI NOAR'],
            //            ['nim' => 2211523001, 'name' => 'WULANDARI YULIANIS'],
            //            ['nim' => 2211523002, 'name' => 'HALEEF RAYYAN'],
            //            ['nim' => 2211523003, 'name' => 'REGINA NATHAMIYA PRAMIJA'],
            //            ['nim' => 2211523004, 'name' => 'FAJRIN PUTRA PRATAMA'],
            //            ['nim' => 2211523005, 'name' => 'INTAN SALMA DENAIDY'],
            //            ['nim' => 2211523006, 'name' => 'SISTRI MAHIRA'],
            //            ['nim' => 2211523007, 'name' => 'CINDY ARWINDA PUTRI'],
            //            ['nim' => 2211523008, 'name' => 'HENI YUNIDA'],
            //            ['nim' => 2211523009, 'name' => 'ATHAYA CLARA DIVA'],
            //            ['nim' => 2211523010, 'name' => 'AZHRA MEISA KHAIRANI'],
            //            ['nim' => 2211523011, 'name' => 'TEGAR ANANDA'],
            //            ['nim' => 2211523012, 'name' => 'SYAUQI NABIIH MARWA'],
            //            ['nim' => 2211523013, 'name' => 'SHERLY ANANDA PUTRI'],
            //            ['nim' => 2211523014, 'name' => 'RANIA SHOFI MALIKA'],
            //            ['nim' => 2211523015, 'name' => 'MUHAMMAD HABIBI'],
            //            ['nim' => 2211523016, 'name' => 'ZHAFIRA SYARAFINA'],
            //            ['nim' => 2211523017, 'name' => 'VATYA ARSHA MAHMUDI'],
            //            ['nim' => 2211523018, 'name' => 'NAJWA NUR FAIZAH'],
            //            ['nim' => 2211523019, 'name' => 'NIKEN KHALILAH HAMUTI'],
            //            ['nim' => 2211523020, 'name' => 'LAURA IFFA RAZITTA'],
            //            ['nim' => 2211523021, 'name' => 'MUHAMMAD FARHAN'],
            //            ['nim' => 2211523022, 'name' => 'DAFFA AGUSTIAN SAADI'],
            //            ['nim' => 2211523023, 'name' => 'FAIZ HADYAN'],
            //            ['nim' => 2211523024, 'name' => 'MEUTIA DEWI PUTRI KARTIKA'],
            //            ['nim' => 2211523025, 'name' => 'M.FACHRI HABIBIE'],
            //            ['nim' => 2211523026, 'name' => 'CHALVINA SUJA RAHAYU'],
            //            ['nim' => 2211523027, 'name' => 'DZIKRI FAKHRY'],
            //            ['nim' => 2211523028, 'name' => 'MUHAMMAD FAIZ AL-DZIKRO'],
            //            ['nim' => 2211523029, 'name' => 'ALIFIA SIERA YUDHA'],
            //            ['nim' => 2211523030, 'name' => 'KHALIED NAULY MATURINO'],
            //            ['nim' => 2211523031, 'name' => 'MUHAMMAD ZAKI ANDAFI'],
            //            ['nim' => 2211523032, 'name' => 'MUHAMMAD RYAN ASHOFFAN'],
            //            ['nim' => 2211523033, 'name' => 'MUHAMMAD FAUZAN NOFIAN'],
            //            ['nim' => 2211523034, 'name' => 'MUHAMMAD FARIZ'],
            //            ['nim' => 2211523035, 'name' => 'DARREL RAJENDRA KURNIA'],
            //            ['nim' => 2211523036, 'name' => 'NABILA R. DZAKIRA'],
            //            ['nim' => 2211523037, 'name' => 'RAHMATUL FA DILLA']
        ];

        $dept = Department::where('name', 'Sistem Informasi')
            ->first();
        $lecturers = Lecturer::all();

        foreach ($students as $student) {
            $newUser = User::create([
                'username' => $student['nim'],
                'email' => $student['nim'].'@students.unand.ac.id',
                'password' => Hash::make('password'),
                'name' => $student['name'],
            ]);
            $student['id'] = $newUser->id;
            $student['year'] = intval('20'.substr($student['nim'], 0, 2));
            $student['department_id'] = $dept->id;
            $student['counselor_id'] = array_rand($lecturers->pluck('id', 'id')->toArray());
            $student['religion'] = 1;
            $student['name'] = ucfirst($student['name']);
            Student::create($student);
        }
    }
}
