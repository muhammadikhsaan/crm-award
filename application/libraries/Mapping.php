<?php
class Mapping{
    public $datel = array(
        array('nama' => 'Banjarnegara', 'cbd' => '2601'),
        array('nama' => 'Bantul', 'cbd' => '3301'),
        array('nama' => 'Batang', 'cbd' => '2701'),
        array('nama' => 'Blora', 'cbd' => '3101'),
        array('nama' => 'Brebes', 'cbd' => '2702'),
        array('nama' => 'Cilacap', 'cbd' => '2602'),
        array('nama' => 'Jepara', 'cbd' => '3102'),
        array('nama' => 'Kebumen', 'cbd' => '2801'),
        array('nama' => 'Kendal', 'cbd' => '3201'),
        array('nama' => 'Klaten', 'cbd' => '3004'),
        array('nama' => 'Kudus', 'cbd' => '3103'),
        array('nama' => 'Magelang', 'cbd' => '2802'),
        array('nama' => 'Muntilan', 'cbd' => '2803'),
        array('nama' => 'Pati', 'cbd' => '3104'),
        array('nama' => 'Pekalongan', 'cbd' => '2703'),
        array('nama' => 'Pemalang', 'cbd' => '2704'),
        array('nama' => 'Purbalingga', 'cbd' => '2603'),
        array('nama' => 'Purwodadi', 'cbd' => '3105'),
        array('nama' => 'Purwokerto', 'cbd' => '2604'),
        array('nama' => 'Purworejo', 'cbd' => '2804'),
        array('nama' => 'Salatiga', 'cbd' => '3005'),
        array('nama' => 'Semarang', 'cbd' => '3202'),
        array('nama' => 'Slawi', 'cbd' => '2705'),
        array('nama' => 'Sleman', 'cbd' => '3302'),
        array('nama' => 'Solo', 'cbd' => '3001'),
        array('nama' => 'Sragen', 'cbd' => '3002'),
        array('nama' => 'Tegal', 'cbd' => '2706'),
        array('nama' => 'Temanggung', 'cbd' => '2805'),
        array('nama' => 'Ungaran', 'cbd' => '3203'),
        array('nama' => 'Wonogiri', 'cbd' => '3003'),
        array('nama' => 'Wonosobo', 'cbd' => '2806'),
        array('nama' => 'Yogyakarta', 'cbd' => '3303')
    );

    public static $MAPPING = array(
        "CBD" => array(
            "WITEL" =>  array(
                31 => "Kudus",
                28 => "Magelang",
                27 => "Pekalongan",
                26 => "Purwokerto",
                32 => "Semarang",
                30 => "Solo",
                33 => "Yogyakarta"
            ), 
            "DATEL" => array(
                2601 => 'Banjarnegara',
                3301 => 'Bantul',
                2701 => 'Batang',
                3101 => 'Blora',
                2702 => 'Brebes',
                2602 => 'Cilacap',
                3102 => 'Jepara',
                2801 => 'Kebumen',
                3201 => 'Kendal',
                3004 => 'Klaten',
                3103 => 'Kudus',
                2802 => 'Magelang',
                2803 => 'Muntilan',
                3104 => 'Pati',
                2703 => 'Pekalongan',
                2704 => 'Pemalang',
                2603 => 'Purbalingga',
                3105 => 'Purwodadi',
                2604 => 'Purwokerto',
                2804 => 'Purworejo',
                3005 => 'Salatiga',
                3202 => 'Semarang',
                2705 => 'Slawi',
                3302 => 'Sleman',
                3001 => 'Solo',
                3002 => 'Sragen',
                2706 => 'Tegal',
                2805 => 'Temanggung',
                3203 => 'Ungaran',
                3003 => 'Wonogiri',
                2806 => 'Wonosobo',
                3303 => 'Yogyakarta'
            )
        )
    );

    public static function get_mapping($index = null){
        if(empty($index)) {
            return self::$MAPPING;
        }
        return self::$MAPPING[$index];
    }
}