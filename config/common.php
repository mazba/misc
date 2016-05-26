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
    'academic_training'=>[
        1=>'Academic',
        2=>'Training'
    ],

    'status_options' => [
        1 => 'Active',
        2 => 'In-Active'
    ],
    'supplier_type' => [
        1 => 'Individual ',
        2 => 'Proprietary',
        3 => 'Limited Firm',
        4 => 'Corporation',
        5 => 'International',
    ],
    'deal_type' => [
        1 => 'consultancy',
        2 => 'product',
        3 => 'service',
        4 => 'construction'
    ],

    'item_conditions' => [
        'Excellent' => 1,
        'Very Good' => 2,
        'Good' => 3,
        'Satisfy' => 4,
        'Poor' => 5
    ],

    'document_type' => [
        'License' => 1,
        'Agreement' => 2,
        'Purchase Order' => 3,
        'Requisition Order' => 4,
        'Other' => 5
    ],

    'depreciate_method' => [
        'Straight line method' => 1,
        'Declining balance method' => 2,
        'Sum of the years digits method' => 3,
        'Units of Activity Depreciation' => 4
    ],

    'item_assign_type' => [
        'Individual Assign' => 1,
        'Office Department Assign' => 2
    ],

    'item_withdrawal_type' => [
        'Archived' => 1,
        'Broken' => 2,
        'Lost/Stolen'=>4,
        'Out for Repair/Maintenance'=>5,
        'User Transfer'=>6,
        'Office Order'=>7,
    ],
    'lpr_range'=>60,//Leave preparatory to Retirement
    'experience_report_type'=>['1'=>'Remaining Time Of LPR', '2'=>'Years Of Experience'],
];