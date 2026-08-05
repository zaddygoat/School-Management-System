<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
include "../conn.php";
if(!isset($_SESSION['institute']))
{
	header("location:index.php");
}

$tabarray = array();
if($_SESSION['type']=='admin')
{
    $tabarray = array(1.1,1.2,1.3,1.4,1.5,1.7,2.1,2.2,2.3,2.4,2.5,2.6,2.7,2.8,3.1,4.1,4.2,4.3,4.4,4.5,4.6,4.7,4.8,4.9,4.101,4.11,4.12,4.13,4.14,4.15,4.16,4.17,4.18,4.19,5.1,5.2,5.3,6.1,6.2,7.1,7.2,7.3,7.4,7.5,7.6,7.7,7.8,7.9,8.1,8.2,8.3,8.4,8.5,8.6,9.1,4.23);
}
elseif($_SESSION['type']=='admissioncommittee')
{
    $tabarray = array(4.1,4.15,4.19);
    //$tabarray = array(4.1,4.4,4.14,4.15,4.16,4.17,8.5);
}
elseif($_SESSION['type']=='viceprincipal')
{
    $tabarray = array(4.1,4.15,4.19);
    //$tabarray = array(4.1,4.4,4.14,4.15,4.16,4.17,8.5);
}
elseif($_SESSION['type']=='examcommittee')
{
    $tabarray = array(1.2,1.7);
}
elseif($_SESSION['type']=='accounts')
{
    $tabarray = array(2.6,2.61,4.7);    
}
elseif($_SESSION['type']=='trust')
{
    $tabarray = array(2.7,4.18,8.5,4.23);    
}
elseif($_SESSION['type']=='user')
{
    $tabarray = array(2.4,2.5,2.6,2.61,2.62,2.7,2.8,4.1,4.5,4.15,4.17,4.18,4.3,4.4,4.51,4.151,4.12,2.42,2.43,2.44,4.23);    
}
else
{
    $tabarray = array(2.2,2.4,2.5,2.6,2.7,2.8,4.1,4.4,4.12,4.19);    
}
?>
<div class="text-center">
	<img src="../assets/icon/student_and_login.png" class="img-fluid">
    <h5>Students Management</h5>
</div>
<div class="sidebar_table">
    <a id="4.1" style="display:<?php echo(in_array(4.1, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='students.php' || basename($_SERVER['PHP_SELF'])=='document-verify.php' || basename($_SERVER['PHP_SELF'])=='change-course.php')?'activeTab':''?>" href="students.php?page=1&academic_year=<?php echo $_SESSION['academicYear']?>&filterstatus=">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Verify and Approve Students</div>
    </a>
    <a id="4.17" style="display:<?php echo(in_array(4.17, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='master_list.php')?'activeTab':''?>" href="master_list.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Master List</div>
    </a>
    <a id="4.14" style="display:<?php echo(in_array(4.14, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='disapprove_students.php')?'activeTab':''?>" href="disapprove_students.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Disapprove Students</div>
    </a>
    <a id="4.16" style="display:<?php echo(in_array(4.16, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='unlock_form.php')?'activeTab':''?>" href="unlock_form.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Unlock Students form</div>
    </a>
    <?php /* ?><a id="4.15" style="display:<?php echo(in_array(4.15, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='admission_statistics.php')?'activeTab':''?>" href="admission_statistics.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Admission Statistics</div>
    </a><?php */ ?>
    <a id="4.19" style="display:<?php echo(in_array(4.19, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='admission_status.php')?'activeTab':''?>" href="admission_status.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Admission Status</div>
    </a>
    <a id="4.18" style="display:<?php echo(in_array(4.18, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='caste_wise_data.php')?'activeTab':''?>" href="caste_wise_data.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Caste Wise Data</div>
    </a>
         <a id="4.23" style="display:<?php echo(in_array(4.23, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='mother_tongue_wise_data.php')?'activeTab':''?>" href="mother_tongue_wise_data.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Mother Tongue Wise Data</div>
    </a>
    <a id="4.2" style="display:<?php echo(in_array(4.2, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='notice.php')?'activeTab':''?>" href="notice.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Notice To Students</div>
    </a>
    <!--<a id="4.3" style="display:<?php echo(in_array(4.3, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='rollno-division.php')?'activeTab':''?>" href="rollno-division.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Assign Roll No. & Division</div>
    </a>-->
    <a id="4.4" style="display:<?php echo(in_array(4.4, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='roll_call_list.php')?'activeTab':''?>" href="roll_call_list.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>View Roll Call List</div>
    </a>
    <a id="4.5" style="display:<?php echo(in_array(4.5, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='students-details.php' || basename($_SERVER['PHP_SELF'])=='student-profile.php')?'activeTab':''?>" href="students-details.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Manage Students</div>
    </a>
    <a id="4.6" style="display:<?php echo(in_array(4.6, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='upload_prn.php' || basename($_SERVER['PHP_SELF'])=='check_prn_data.php')?'activeTab':''?>" href="upload_prn.php?data=1">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Upload PRN/GR NO.</div>
    </a>
    <a id="4.7" style="display:<?php echo(in_array(4.7, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='cancel-admission.php' || basename($_SERVER['PHP_SELF'])=='cancel-student.php')?'activeTab':''?>" href="cancel-admission.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Cancel Admission</div>
    </a>
    <!--<a id="4.8" style="display:<?php echo(in_array(4.8, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='cancel-admission-students.php')?'activeTab':''?>" href="cancel-admission-students.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Cancel Admission RECEIPT</div>
    </a>-->
    <a id="4.9" style="display:<?php echo(in_array(4.9, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='change-subjects.php')?'activeTab':''?>" href="change-subjects.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Change Semester Subjects</div>
    </a>
    <a id="4.101" style="display:<?php echo(in_array(4.101, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='upload-existing-students.php')?'activeTab':''?>" href="upload-existing-students.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Upload Existing Students</div>
    </a>
    <a id="4.11" style="display:<?php echo(in_array(4.11, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='promote-students.php')?'activeTab':''?>" href="promote-students.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Promote Students</div>
    </a>
    <a id="4.12" style="display:<?php echo(in_array(4.12, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='bonafide.php')?'activeTab':''?>" href="bonafide.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Bonafide</div>
    </a>
    <a id="4.13" style="display:<?php echo(in_array(4.13, $tabarray)?'':'none')?>" class="sidebar_table-row <?php echo (basename($_SERVER['PHP_SELF'])=='retrive-student-data.php')?'activeTab':''?>" href="retrive-student-data.php">
        <div class="sidebar_table-cell"><i class="fa fa-angle-double-right">&nbsp;</i>Retrive Username/Password/OTP</div>
    </a>
</div>