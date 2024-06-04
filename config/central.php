<?php

return [
    'default_paginate_item' => 50,

    'photo_size' => [
        's' => '60',
        'm' => '200',
        'l' => '450',
    ],

    'system_roles' => [
        'administrator' => 'admin',
        'lecturer' => 'dosen',
        'student' => 'mahasiswa',
        'staff' => 'tendik',
        'gkm' => 'gkm',
    ],

    'path' => [
        'avatar' => 'avatar/',
        'user_photo' => 'photo/',
        'staff_photo' => 'photo/tendik',
        'lecturer_photo' => 'photo/lecturer',
        'student_photo' => 'photo/student',
        'ijazah' => 'ijazah',
        'community_services' => [
            'report_file' => 'community_services/report',
            'proposal_file' => 'community_services/proposal',
        ],
        'thesis' => [
            'logbook' => 'thesis/logbook',
            'proposal' => 'thesis/proposal',
            'confirmation_sheet' => 'thesis/confirmation_sheet',
            'final_report' => 'thesis/final_report',
            'seminar_report' => 'thesis/seminar_report',
            'seminar_slide' => 'thesis/seminar_slide',
            'seminar_journal' => 'thesis/seminar_journal',
            'seminar_attendance' => 'thesis/seminar_attendance',
            'defense_report' => 'thesis/defense_report',
            'defense_slide' => 'thesis/defense_slide',
            'defense_journal' => 'thesis/defense_journal',
        ],
    ],

    'thesis_grades' => [
        'A' => 'A',
        'A-' => 'A-',
        'B+' => 'B+',
        'B' => 'B',
        'B-' => 'B-',
        'C+' => 'C+',
        'C' => 'C',
    ],

    'position' => [
        1 => 'Ketua',
        2 => 'Anggota',
    ],

    'family_relationship' => [
        1 => 'Suami/Istri',
        2 => 'Ayah/Ibu',
        3 => 'Ayah/Ibu Mertua',
        4 => 'Anak Kandung',
        5 => 'Saudara Kandung',
        6 => 'Anak Angkat',
    ],

    'gender' => [
        1 => 'Pria',
        2 => 'Wanita',
    ],

    'marital_status' => [
        1 => 'Belum Menikah',
        2 => 'Menikah',
        3 => 'Janda/Duda',
    ],

    'religion' => [
        1 => 'Islam',
        2 => 'Kristen Protestan',
        3 => 'Kristen Katolik',
        4 => 'Hindu',
        5 => 'Budha',
    ],

    'alive_status' => [
        0 => 'Meninggal',
        1 => 'Masih Hidup',
    ],

    'domestic' => [
        0 => 'Dalam Negri',
        1 => 'Luar Negri',
    ],

    'education_level' => [
        1 => 'TK',
        2 => 'SD Sederajat',
        3 => 'SMP Sederajat',
        4 => 'SMA Sederajat',
        5 => 'D1',
        6 => 'D2',
        7 => 'D3',
        8 => 'D4',
        9 => 'S1',
        10 => 'S2',
        11 => 'S3',
    ],

    'attendance_student' => [
        0 => 'Absen',
        1 => 'Hadir',
        2 => 'Absen',
        3 => 'Izin',
        4 => 'Sakit'],

    'course_plan_detail_activity' => [
        1 => 'Luring', // Method : Luring & Daring
        2 => 'Daring', // Method : Mandiri & Kolaboratif
    ],

    'day_convertion' => [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ],

    'grade_convertion' => [
        'A' => [
            'min' => 80,
            'max' => 100,
        ],
        'A-' => [
            'min' => 75,
            'max' => 80,
        ],
        'B+' => [
            'min' => 70,
            'max' => 75,
        ],
        'B' => [
            'min' => 65,
            'max' => 70,
        ],
        'B-' => [
            'min' => 60,
            'max' => 65,
        ],
        'C+' => [
            'min' => 55,
            'max' => 60,
        ],
        'C' => [
            'min' => 50,
            'max' => 55,
        ],
        'D' => [
            'min' => 45,
            'max' => 50,
        ],
        'E' => [
            'min' => 0,
            'max' => 45,
        ],
    ],
];
