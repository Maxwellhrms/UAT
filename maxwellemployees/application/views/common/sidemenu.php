<?php
$isApprovals = $this->session->userdata('is_approvals');
$isLoans = $this->session->userdata('is_loans', 1);
$employeecode = $this->session->userdata('session_loginperson_id');

$menu = [
    [
        "title" => "Main",
        "type"  => "title"
    ],
    [
        "icon" => "la la-dashboard",
        "label" => "Dashboard",
        "submenu" => array_values(array_filter([
            ($isApprovals == 1 &&in_array($employeecode, ['M0009','MD0001'])) ? [
                "label" => "Charts Dashboard",
                "url"   => "Employee/employeedeatiledsummary"
            ] : null,
            [
                "label" => "Employee Dashboard",
                "url"   => "Employee/employeedashboard"
            ],
            ($isApprovals == 1) ? [
                "label" => "Manager Dashboard",
                "url"   => "Employee/managerdashboard"
            ] : null,
        ]))
    ],

    [
        "title" => "Employees",
        "type"  => "title"
    ],
    [
        "icon" => "la la-user",
        "label" => "Employees",
        "submenu" => [
            [
                "label" => "Employee Profile",
                "url"   => "Employee/employeesprofile"
            ],
            [
                "label" => "Self Attendance",
                "url"   => "Employee/employeeattendancepunch"
            ],
            [
                "label" => "Self Regulations",
                "url"   => "Employee/employeesRegulations"
            ],
            [
                "label" => "Self Leaves",
                "url"   => "Employee/employeesleaves"
            ],
            [
                "label" => "Performance Appraisal",
                "url"   => "Employee/Appraisal"
            ],
            [
                "label" => "Pay Slips",
                "url"   => "Employee/employeepayslips"
            ]
        ]
    ]
];
$menu[] = [
    "icon" => "la la-lock",
    "label" => "Change Password",
    "url"   => "Employee/changepassword"
];
/* Add Managers section only if is_approvals = 1 */
if ($isApprovals == 1) {
    $menu[] = [
        "title" => "Managers",
        "type"  => "title"
    ];

    $menu[] = [
        "icon" => "la la-user-check",
        "label" => "Manager Approvals",
        "submenu" => [
            [
                "label" => "Team Under You",
                "url"   => "Employee/managerTeamMembers"
            ],
            [
                "label" => "Leave Approvals",
                "url"   => "Employee/managerApprovalLeaves"
            ],
            [
                "label" => "Regulations Approvals",
                "url"   => "Employee/managerApprovalRegulations"
            ],
            [
                "label" => "Geo Punches",
                "url"   => "Employee/managerTeamMembersGeoLocationAttendance"
            ],
        ]
    ];

}

/* Common menu items */

$menu[] =  [
        "title" => "Company",
        "type"  => "title"
    ];
if($isLoans == 1){
$menu[] = [
    "icon" => "la la-credit-card",
    "label" => "Employee Loans",
    "url"   => "Employee/employeeLoanslist"
];
}

$menu[] = [
    "icon" => "la la-file-pdf-o",
    "label" => "Policies",
    "url"   => "Employee/policies"
];

$menu[] = [
    "icon" => "la la-umbrella-beach",
    "label" => "Holidays",
    "url"   => "Employee/holidayslist"
];
$current = uri_string(); // Example: Employee/employeedashboard
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <?php foreach ($menu as $item): ?>

                    <?php if (isset($item['type']) && $item['type'] == 'title'): ?>
                        <li class="menu-title">
                            <span><?= $item['title']; ?></span>
                        </li>

                    <?php elseif (isset($item['submenu'])): 
                        
                        // Check active submenu
                        $isActive = false;
                        foreach ($item['submenu'] as $sub) {
                            if ($current == $sub['url']) {
                                $isActive = true;
                                break;
                            }
                        }
                    ?>
                        <li class="submenu">
                            <a href="#" class="<?= $isActive ? 'noti-dot' : '' ?>">
                                <i class="<?= $item['icon']; ?>"></i> 
                                <span><?= $item['label']; ?></span> 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul style="<?= $isActive ? 'display:block;' : 'display:none;' ?>">
                                <?php foreach ($item['submenu'] as $sub): ?>
                                    <li>
                                        <a href="<?= base_url($sub['url']); ?>"
                                           class="<?= ($current == $sub['url']) ? 'active noti-dot' : '' ?>">
                                           <?= $sub['label']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                    <?php else: ?>
                        <li class="<?= ($current == $item['url']) ? 'active' : '' ?>">
                            <a href="<?= base_url($item['url']); ?>"
                               class="<?= ($current == $item['url']) ? 'noti-dot' : '' ?>">
                                <i class="<?= $item['icon']; ?>"></i> 
                                <span><?= $item['label']; ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>