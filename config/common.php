<?php
/**
 * Created by PhpStorm.
 * User: Mazba
 * Date: 2/28/2016
 * Time: 11:27 AM
 */
return [
    'user_group' => [
        'super_admin' => 1,
        'office_admin' => 2,
        'office_user' => 3
    ],

    'language_options'=>[
        'Excellent'=>'Excellent','Moderate'=>'Moderate','Good'=>'Good','Poor'=>'Poor'
    ],
    'blood_groups'=>[
        'A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'
    ],
    'languages'=>[
        'bangla'=>'Bangla','english'=>'English','hindi'=>'Hindi','arabic'=>'Arabic','portuguese'=>'Portuguese','russian'=>'Russian','chinese'=>'Chinese','spanish'=>'Spanish'
    ],
    'genders'=>[
        1=>'Male',
        2=>'Female'
    ],
    'religions'=>[
        1=>'Islam',
        2=>'Hindu',
        3=>'Buddhist',
        4=>'Christian',
    ],
    'status_options' => [
        1 => 'Active',
        2 => 'In-Active'
    ],
    'office_level'=>[
        'HQ'=>1,
        'Divisional'=>2,
        'District'=>3,
        'Upazila'=>4,
//        'Union'=>4,
    ],
    'application_status'=>[
        'Reject'=>0,
        'Pending'=>1,
        'Approved'=>2,
        'Investigating'=>3,
        'Closed'=>4,
    ],
    'party_type'=>[
        'appellant'=>1,
        'defendant'=>2
    ],
    'lawyers_type'=>[
        'appellant'=>1,
        'defendant'=>2
    ]
];