<?php include('log_check.php');
$cmpId=$_SESSION['cmpId'];
$uiType=$_SESSION['iType'];
$userId=$_SESSION['uId'];
$uRole=$_SESSION['uRole'];
$uloc=$_SESSION['loc'];
//echo $cmpId."<Br>";
?>
<!DOCTYPE html>
<html lang="en">

<head>

 <?php
 include("inc/meta.php");
 ?>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="selectcss/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop 
  { left: -9000px;
  
  }
  </style>
<script>
function GetSelected() {
        //Create an Array.
        var selected = new Array();
 
        //Reference the Table.
        var sval = document.getElementById("Select_values");
 
        //Reference all the CheckBoxes in Table.
        var chks = sval.getElementsByTagName("INPUT");
 
        // Loop and push the checked CheckBox value in Array.
        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                selected.push(chks[i].value);
            }
			
        }
    	document.getElementById('selectval').value=selected;
        //Display the selected CheckBox values.
        
    }
 
function GetSelectedSub()
{
//Create an Array.
        var selected = new Array();
 
        //Reference the Table.
        var sval = document.getElementById("Select_sub_values");
 		var iType=document.getElementById("iType").value;
        //Reference all the CheckBoxes in Table.
        var chks = sval.getElementsByTagName("INPUT");
 
        // Loop and push the checked CheckBox value in Array.
        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
				//alert(iType+" || "+chks[i].value);
				if(iType=='1')
				{
					if(chks[i].value=='4')
					{
						chks[i].checked=false;
					}
					
					if(chks[i].value!='4')
					{
						selected.push(chks[i].value);
					}
				}
                else if(iType=='2')
				{
					if(chks[i].value=='3')
					{
						chks[i].checked=false;
					}
					
					if(chks[i].value!='3')
					{
						selected.push(chks[i].value);
					}
				}
				else
				{
					selected.push(chks[i].value);
				}
            }
			
        }
    	document.getElementById('selectsubval').value=selected;
        //Display the selected CheckBox values.
}
function getCreateAct()	
{
  if(document.getElementById('rbYes').checked==true)
  {
	 document.getElementById('txtaction_cr').value=1;
  }
  
  if(document.getElementById('rbNo').checked==true)
  {
	 document.getElementById('txtaction_cr').value=0;
  }	
}
	
function getEditAct()
{
  if(document.getElementById('rbYes').checked==true)
  {
	 document.getElementById('txtaction_ed').value=1;
  }
  
  if(document.getElementById('rbNo').checked==true)
  {
	 document.getElementById('txtaction_ed').value=0;
  }	
}
	
function getDeleteAct()
{
  if(document.getElementById('rbdYes').checked==true)
  {
	 document.getElementById('txtaction_del').value=1;
  }
  
  if(document.getElementById('rbdNo').checked==true)
  {
	 document.getElementById('txtaction_del').value=0;
  }	
}
	
function getViewAct()
{
  if(document.getElementById('rbVYes').checked==true)
  {
	 document.getElementById('txtaction_view').value=1;
  }
  
  if(document.getElementById('rbVNo').checked==true)
  {
	 document.getElementById('txtaction_view').value=0;
  }	
}  
	
function ShowSubM()
{
        if(document.getElementById('txtmaster').checked==true)
        {
			document.getElementById('ttt').style.visibility='visible';
            document.getElementById('ttt').style.overflow='visible';
            document.getElementById('ttt').style.height='auto';
			
            document.getElementById('submaster').style.visibility='visible';
            document.getElementById('submaster').style.overflow='visible';
            document.getElementById('submaster').style.height='auto';
        }
        else
        {
            document.getElementById('submaster').style.visibility='hidden';
            document.getElementById('submaster').style.overflow='hidden';
            document.getElementById('submaster').style.height='0px';
            document.getElementById('selectsubval').value="-1";
            document.getElementById('txt1').checked=false;
            document.getElementById('txt2').checked=false;
            document.getElementById('txt3').checked=false;
            document.getElementById('txt4').checked=false;
            document.getElementById('txt5').checked=false;
        }
		
		if(document.getElementById('txtreport').checked==true)
        {
			document.getElementById('ttt').style.visibility='visible';
            document.getElementById('ttt').style.overflow='visible';
            document.getElementById('ttt').style.height='auto';
			
            document.getElementById('subRpt').style.visibility='visible';
            document.getElementById('subRpt').style.overflow='visible';
            document.getElementById('subRpt').style.height='auto';
        }
        else
        {
            document.getElementById('subRpt').style.visibility='hidden';
            document.getElementById('subRpt').style.overflow='hidden';
            document.getElementById('subRpt').style.height='0px';
            document.getElementById('selectsubRpt').value="-1";
            document.getElementById('txtR1').checked=false;
            document.getElementById('txtR1').checked=false;
            document.getElementById('txtR1').checked=false;
            document.getElementById('txtR1').checked=false;
            document.getElementById('txtR1').checked=false;
        }
		
		if(document.getElementById('txtreport2').checked==true)
        {
			document.getElementById('ttt').style.visibility='visible';
            document.getElementById('ttt').style.overflow='visible';
            document.getElementById('ttt').style.height='auto';
			
            document.getElementById('subRpt2').style.visibility='visible';
            document.getElementById('subRpt2').style.overflow='visible';
            document.getElementById('subRpt2').style.height='auto';
        }
        else
        {
            document.getElementById('subRpt2').style.visibility='hidden';
            document.getElementById('subRpt2').style.overflow='hidden';
            document.getElementById('subRpt2').style.height='0px';
            document.getElementById('selectsubRpt2').value="-1";
            document.getElementById('txtRR1').checked=false;
            document.getElementById('txtRR2').checked=false;
            document.getElementById('txtRR3').checked=false;
            document.getElementById('txtRR4').checked=false;
            document.getElementById('txtRR5').checked=false;
        }
    }

 function getusernm()
 {
	var uname = document.getElementById("txtname").value;
	//alert(uname);
	
	  var scriptUrl='getname.php?nm='+uname;
	  $.ajax({url:scriptUrl,success:function(result)
		  {
		    //alert(result);
			var str = result;
		    if(str == '1')
			{
				alert('Username Already Exist...!');
				document.getElementById("txtname").value="";
				document.getElementById("txtname").focus();
			}
		  }
		  });
 }
 </script>
 
 <script>
function delUser(id)
 {

	
	var r = confirm("Do you want to Delete this User....?");
	if (r == true) {
	var scriptUrl ='del_user.php?id='+id;
	//alert(scriptUrl);
	$.ajax({url:scriptUrl,success:function(result)
	{	
	alert('Record Deleted Successfully...');
	window.location.href='user_creation.php';
	}});
	
	} 
	else {
	txt = "You Pressed Cancel!";
	}

}
	 
function changeAction(id)
{
//alert('hi');
window.open("changeAction.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
}
	 
function viewLoc(id)
{
//alert('hi');
window.open("viewLocations.php?ID="+id, "_blank", "toolbar=yes, scrollbars=yes, resizable=no, top=60, left=0, width=700, height=600");
}
</script>   
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php
include("inc/menu.php");
?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>          </button>

<!-- Topbar Search -->


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->


<!-- Nav Item - Alerts -->


<!-- Nav Item - Messages -->


<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<?php include('inc/header.php');?>
</ul>
</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h4 mb-0 text-gray-800" style="height:0px;padding-bottom: 5px;">User Creation</h1>     
</div>

<div class="card o-visible border-0 shadow-lg my-2">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">          
<div class="col-lg-12">
<div class="p-2">  
	
<form class="user" action="#" method="POST" id="companyMaster" name="companyMaster" enctype="multipart/form-data"> 
<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uId']?>">
<input type="hidden" id="urole" name="urole" value="<?php echo $uRole;?>">
<input type="hidden" id="uiType" name="uiType" value="<?php echo $uiType;?>">
<input type="hidden" id="uloc" name="uloc" value="<?php echo $uloc;?>">	
<input type="hidden" id="locRec" name="locRec" value="0" readonly>	
<table cellpadding="5px">
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Company</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="compId" name="compId" tabindex="1" required onChange="getLoc()" style="width:250px;">
<option value="0">Select</option>
<?php
include("mysql.connect.php");
$q="SELECT ID,CONCAT(company_code,' - ', company_name) AS company_name FROM company_tbl WHERE sts='0'";
$s=$mysql->prepare($q);
$s->setFetchMode(PDO::FETCH_ASSOC);
$s->execute();
while($r=$s->fetch())
{
  echo "<option value=".$r['ID'].">".$r['company_name']."</option>";
}
$mysql=null;
?>
</select>
</td>		

<td valign="top"><label class="m-0 font-weight-bold text-primary">Product Category</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="iType" name="iType" tabindex="2" onChange="getLoc();" style="width:250px;" required>
<option value="0">Select</option>
<option value="1">RAW MATERIAL</option>
<option value="2">FINISHED GOODS</option>
<option value="3">BOTH</option>
</select>
</td>	
	
<td valign="top"><label class="m-0 font-weight-bold text-primary">Location</label></td>	
<td valign="top">:</td>	
<td valign="top">
<select class="chosen-select form-control form-control-sm" id="location" name="location" tabindex="3" onChange="addMultiLocation('contact_tbl')" style="width:250px;">
<option value="0">Select</option>
</select>
</td>		
</tr>

<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Multiple Location</label></td>	
<td valign="top">:</td>	
<td valign="top">
<table id="contact_tbl" ></table>
</td>
	

<td valign="top"><label class="m-0 font-weight-bold text-primary">Username</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="text" class="form-control form-control-sm" id="txtname" name="txtname" placeholder="Username" onChange="getusernm();" tabindex="3">
</td>		
	
<td valign="top"><label class="m-0 font-weight-bold text-primary">Password</label></td>	
<td valign="top">:</td>	
<td valign="top">
<input type="password" class="form-control form-control-sm" id="txtpassword" name="txtpassword" placeholder="Password" tabindex="4"></td>		
</tr>
	
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Access</label></td>	
<td valign="top">:</td>	
<td valign="top" colspan="6" style="font-weight:bold;">
<div id="Select_values">
<input id="txtmaster" type="checkbox" value="1" onclick = "GetSelected();ShowSubM();" tabindex="5" />&nbsp;&nbsp;Master
<input id="txtoutputformula" type="checkbox" value="2" tabindex="6.1"/>&nbsp;Stock Entry
<input id="txtApp" type="checkbox" value="3" onclick = "GetSelected();ShowSubM();"  tabindex="6.2"/>&nbsp;Lock Quantity
<input id="txtreport" type="checkbox" value="4" onclick = "GetSelected();ShowSubM();"  tabindex="6.3"/>&nbsp;Report
<input id="txtreport2" type="checkbox" value="5" onclick = "GetSelected();ShowSubM();"  tabindex="6.4"/>&nbsp;Report2
<input id="txtApp" type="checkbox" value="6" onclick = "GetSelected();ShowSubM();"  tabindex="6.5"/>&nbsp;Mobile App
<input type="hidden" id="selectval" name="selectval" value="0">
</div>
</td>
</tr>	
</table> 
	
<table cellpadding="5px" id="ttt" style="visibility: hidden;overflow: hidden;height: 0px;">	
<tr id="submaster" style="visibility: hidden;overflow: hidden;height: 0px;">
<td valign="top"><label class="m-0 font-weight-bold text-primary">Sub Access</label></td>	
<td valign="top">:</td>	
<td valign="top" colspan="6" style="font-weight:bold;">
<div id="Select_sub_values">
<input id="txt1" type="checkbox" value="1" onclick = "GetSelectedSub()" tabindex="5.1"/>&nbsp;&nbsp;Company Master
<input id="txt2" type="checkbox" value="2" onclick = "GetSelectedSub()" tabindex="5.2"/>&nbsp;Location Master
<input id="txt3" type="checkbox" value="3" onclick = "GetSelectedSub()" tabindex="5.3"/>&nbsp;RM Master
<input id="txt4" type="checkbox" value="4" onclick = "GetSelectedSub()" tabindex="5.4"/>&nbsp;FG Master
<input id="txt5" type="checkbox" value="5" onclick = "GetSelectedSub()" tabindex="5.5"/>&nbsp;Entry Type Master
<input type="hidden" id="selectsubval" name="selectsubval" value="-1">
</div>
</td>
</tr>
</table>
	
<table cellpadding="5px">	
<tr>
<td valign="top"><label class="m-0 font-weight-bold text-primary">Action</label></td>	
<td valign="top">:</td>	
<td valign="top" colspan="6" style="font-weight:bold;">
<table class="table-bordered">
<tr>
<td>
<div id="Select_values">
<label class="m-0 font-weight-bold">Create</label>
<input id="rbYes" name="rbCreate" type="radio" value="1" onclick = "getCreateAct()"  tabindex="7.1"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbCreate" type="radio" value="0" checked onclick = "getCreateAct()"  tabindex="7.1"/>&nbsp;&nbsp;No
<input type="hidden" id="txtaction_cr" name="txtaction_cr" value="0">  
<br />
</div>
</td>
	
<td>
<div id="Select_values">
<label class="m-0 font-weight-bold">Edit</label>
<input id="rbYes" name="rbAction" type="radio" value="1" onclick = "getEditAct()" tabindex="7.2"/>&nbsp;&nbsp;Yes
<input id="rbNo" name="rbAction" type="radio" value="0" checked onclick = "getEditAct()"  tabindex="7.2"/>&nbsp;&nbsp;No
<input type="hidden" id="txtaction_ed" name="txtaction_ed" value="0">  
<br />
</div>
</td>
	
<td style="padding:5px;">
<div id="Select_values">
<label class="m-0 font-weight-bold">Delete</label>
<input id="rbdYes" name="rbActionDel" type="radio" value="1" onclick = "getDeleteAct()"  tabindex="7.3"/>&nbsp;&nbsp;Yes
<input id="rbdNo" name="rbActionDel" type="radio" value="0" checked onclick = "getDeleteAct()"  tabindex="7.4"/>&nbsp;&nbsp;No
<input type="hidden" id="txtaction_del" name="txtaction_del" value="0">  
<br />
</div>
</td>
	
<td style="padding:5px;">
<div id="Select_values">
<label class="m-0 font-weight-bold">View</label>
<input id="rbVYes" name="rbActionView" type="radio" value="1" onclick = "getViewAct()"  tabindex="7.5"/>&nbsp;&nbsp;Yes
<input id="rbVNo" name="rbActionView" type="radio" value="0" checked onclick = "getViewAct()"  tabindex="7.6"/>&nbsp;&nbsp;No
<input type="hidden" id="txtaction_view" name="txtaction_view" value="0">  
<br />
</div>
</td>	
</tr>
</table>
</td>
</tr>	
</table>	
	
<button type="button" id="btnsub" name="btnsub" class="btn btn-primary" tabindex="8">Create</button>
</form>	
</div>
</div>
</div>
</div>
<div id="abc"></div>	
</div>
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">User Master</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;text-align:center;">No.</th>
<th style="color:#fff;text-align:center;">Name</th>
<th style="color:#fff;text-align:center;">Password</th>
<th style="color:#fff;text-align:center;">Access</th>
<th style="color:#fff;text-align:center;">Sub Access</th>		
<th style="color:#fff;text-align:center;">Create Action</th>
<th style="color:#fff;text-align:center;">Edit Action</th>
<th style="color:#fff;text-align:center;">Delete Action</th>	
<th style="color:#fff;text-align:center;">View Action</th>
<th style="color:#fff;text-align:center;">Location</th>
<th style="color:#fff;text-align:center;">Change Action</th>	
<th style="color:#fff;text-align:center;">Delete</th>
</tr>
</thead>
<?php 
include('mysql.connect.php');
$qq="SELECT id,UserNm,pwd,u_access,sub_access,act_edit AS ed,act_delete AS del,act_create AS cr,act_view AS vw FROM admin_tbl WHERE sts='0' AND role!='admin'";
//echo $qq."<br>";
$stm=$mysql->prepare($qq);
$stm->execute();
$cnt=1;
while($row=$stm->fetch(PDO::FETCH_ASSOC))
{
$id=$row['id'];
echo'<tr style="color:#000;font-weight:600;">';
echo '<td align="center">'.$cnt.'</td>';
echo '<td align="center">'.$row['UserNm'].'</td>';
echo '<td align="center">'.$row['pwd'].'</td>';
//Main Menu

//End of Main Menu
if($row['u_access'] == "1,2,3,4,5")
{
	echo '<td align="center">Master,Stock Entry,Lock Quantity,Report,Report2</td>'; 	
}
else if($row['u_access'] == "1,2,3,4")
{
	echo '<td align="center">Master,Stock Entry,Lock Quantity,Report</td>'; 	
}
else if($row['u_access'] == "1,2,3,5")
{
	echo '<td align="center">Master,Stock Entry,Lock Quantity,Report2</td>'; 	
}
else if($row['u_access'] == "1,2,4,5")
{
	echo '<td align="center">Master,Stock Entry,Report,Report2</td>'; 	
}
else if($row['u_access'] == "1,3,4,5")
{
	echo '<td align="center">Master,Lock Quantity,Report,Report2</td>'; 	
}
else if($row['u_access'] == "1,2,3")
{
	echo '<td align="center">Master,Stock Entry,Lock Quantity</td>'; 	
}
else if($row['u_access'] == "1,2,4")
{
	echo '<td align="center">Master,Stock Entry,Report</td>'; 	
}
else if($row['u_access'] == "1,2,5")
{
	echo '<td align="center">Master,Stock Entry,Report2</td>'; 	
}	
else if($row['u_access'] == "1,3,5")
{
	echo '<td align="center">Master,Lock Quantity,Report2</td>'; 	
}
else if($row['u_access'] == "1,3,4")
{
	echo '<td align="center">Master,Lock Quantity,Report</td>'; 	
}
else if($row['u_access'] == "1,4,5")
{
	echo '<td align="center">Master,Report,Report2</td>'; 	
}	
else if($row['u_access'] == "2,3,4,5")
{
	echo '<td align="center">Stock Entry,Lock Quantity,Report,Report2</td>'; 	
}
else if($row['u_access'] == "2,3,4")
{
	echo '<td align="center">Stock Entry,Lock Quantity,Report</td>'; 	
}
else if($row['u_access'] == "2,3,5")
{
	echo '<td align="center">Stock Entry,Lock Quantity,Report2</td>'; 	
}
else if($row['u_access'] == "3,4,5")
{
	echo '<td align="center">Lock Quantity,Report,Report2</td>'; 	
}
else if($row['u_access'] == "1,2")
{
	echo '<td align="center">Master,Stock Entry</td>'; 	
}
else if($row['u_access'] == "1,3")
{
	echo '<td align="center">Master,Lock Quantity</td>'; 	
}
else if($row['u_access'] == "1,4")
{
	echo '<td align="center">Master,Report</td>'; 	
}
else if($row['u_access'] == "1,5")
{
	echo '<td align="center">Master,Report2</td>'; 	
}
else if($row['u_access'] == "2,3")
{
	echo '<td align="center">Stock Entry,Lock Quantity</td>'; 	
}
else if($row['u_access'] == "2,4")
{
	echo '<td align="center">Stock Entry,Report</td>'; 	
}
else if($row['u_access'] == "2,5")
{
	echo '<td align="center">Stock Entry,Report2</td>'; 	
}
else if($row['u_access'] == "3,4")
{
	echo '<td align="center">Lock Quantity,Report</td>'; 	
}
else if($row['u_access'] == "3,5")
{
	echo '<td align="center">Lock Quantity,Report2</td>'; 	
}
else if($row['u_access'] == "4,5")
{
	echo '<td align="center">Report,Report2</td>'; 	
}
else if($row['u_access'] == "1")
{
	echo '<td align="center">Master</td>'; 	
}
else if($row['u_access'] == "2")
{
	echo '<td align="center">Stock Entry</td>'; 	
}
else if($row['u_access'] == "3")
{
	echo '<td align="center">Lock Quantity</td>'; 	
}
else if($row['u_access'] == "4")
{
	echo '<td align="center">Report</td>'; 	
}
else if($row['u_access'] == "5")
{
	echo '<td align="center">Report2</td>'; 	
}
else
{
	echo '<td align="center">All</td>';
}
//Sub Menu
if($row['sub_access'] == '1,2,3,4,5')
{
echo '<td align="center">Company Master,Location Master,RM Master,FG Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '1,2,3,4')
{
echo '<td align="center">Company Master,Location Master,RM Master,FG Master</td>';  
}
else if($row['sub_access'] == '1,2,3')
{
echo '<td align="center">Company Master,Location Master,RM Master</td>';  
}
else if($row['sub_access'] == '1,2,4,5')
{
echo '<td align="center">Company Master,Location Master,FG Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '1,2,5')
{
echo '<td align="center">Company Master,Location Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '1,3,4,5')
{
echo '<td align="center">Company Master,RM Master,FG Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '1,3,5')
{
echo '<td align="center">Company Master,RM Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '1')
{
echo '<td align="center">Company Master</td>';  
}
else if($row['sub_access'] == '2')
{
echo '<td align="center">Location Master</td>';  
}
else if($row['sub_access'] == '3')
{
echo '<td align="center">RM Master</td>';  
}
else if($row['sub_access'] == '4')
{
echo '<td align="center">FG Master</td>';  
}
else if($row['sub_access'] == '5')
{
echo '<td align="center">Entry Type Master</td>';  
}
else if($row['sub_access'] == '1,2')
{
echo '<td align="center">Company Master,Location Master</td>';  
}
else if($row['sub_access'] == '1,3')
{
echo '<td align="center">Company Master,RM Master</td>';  
}
else if($row['sub_access'] == '1,4')
{
echo '<td align="center">Company Master,FG Master</td>';  
}
else if($row['sub_access'] == '1,5')
{
echo '<td align="center">Company Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '2,3')
{
echo '<td align="center">Location Master,RM Master</td>';  
}
else if($row['sub_access'] == '2,4')
{
echo '<td align="center">Location Master,FG Master</td>';  
}
else if($row['sub_access'] == '2,5')
{
echo '<td align="center">Location Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '3,4')
{
echo '<td align="center">RM Master,FG Master</td>';  
}
else if($row['sub_access'] == '3,5')
{
echo '<td align="center">RM Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '4,5')
{
echo '<td align="center">FG Master,Entry Type Master</td>';  
}
else if($row['sub_access'] == '-1')
{
echo '<td align="center">-</td>';  
}
else
{
echo '<td align="center">All</td>';    
} 
//End of Sub Menu
if($row['cr']=='1')
{
echo '<td align="center">Allowed</td>';  
}
else
{
echo '<td align="center">Not Allowed</td>';  
}
	
if($row['ed']=='1')
{
echo '<td align="center">Allowed</td>';  
}
else
{
echo '<td align="center">Not Allowed</td>';  
}

if($row['del']=='1')
{
echo '<td align="center">Allowed</td>';  
}
else
{
echo '<td align="center">Not Allowed</td>';  
}

if($row['vw']=='1')
{
echo '<td align="center">Allowed</td>';  
}
else
{
echo '<td align="center">Not Allowed</td>';  
}
echo '<td align="center"><a href="javascript:viewLoc('.$id.')"><i class="fa fa-eye"></i></a></td>';	
echo '<td align="center"><a href="javascript:changeAction('.$id.')"><i class="fa fa-edit"></i></a></td>';
echo '<td align="center"><a href="javascript:delUser('.$id.')"><i class="fa fa-trash" style="color:#F00"></i></a></td>';
echo '</tr>';
$cnt++;
}
$mysql=null;
?>
<tbody>
</tbody>
</table>
</div>
</div>
</div>

</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
	  include("inc/footer.php");
	  
	  ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
 <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
    <script src="selectjs/chosen.jquery.js" type="text/javascript"></script>
  <script src="selectjs/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script>
 $("#btnsub").click(function()
  {		
	 	var flag=0;
	 
	 	if($("#compId").val().trim() == "0")
		{
			//alert('hi 1');
			$("#compId").addClass("require");
			alert("Please Select Company...!");
			$("#compId").focus();
			flag=1;
			//return false;
		}
	 	else if($("#iType").val().trim() == "0")
		{
			//alert('hi 2');
			$("#iType").addClass("require");
			alert("Please Select Product Category...!");
			$("#iType").focus();
			flag=1;
			//return false;
		}	 	
	 	else if($("#locRec").val().trim() == "0")
		{
			//alert('hi 2');
			$("#locRec").addClass("require");
			alert("Please Select Locations...!");
			$("#location").focus();
			flag=1;
			//return false;locRec
		}
    	else if($("#txtname").val().trim() == "")
		{
			//alert('hi 3');
			$("#txtname").addClass("require");
			alert("Please Enter Username...!");
			$("#txtname").focus();
			flag=1;
			//return false;
		}		
		else if($("#txtpassword").val().trim() == "")
		{
			//alert('hi 4');
			$("#txtpassword").addClass("require");
			alert("Please Enter Password...!");
			$("#txtpassword").focus();
			flag=1;
			//return false;
		}		
		else if($("#selectval").val().trim() == "0" || $("#selectval").val().trim() == "")
		{
			//alert('hi 5');
			$("#txtmaster").addClass("require");
			alert("Please Check Access Type...!");
			$("#txtmaster").focus();
			flag=1;
			//return false;
		}		
		else if(document.getElementById('txtmaster').checked==true)
		{
			//alert('hi 6 || ' + $("#selectsubval").val());
			//alert($("#selectsubval").val().trim() == "-1")
			if($("#selectsubval").val().trim() == "-1")
			{
				$("#txt1").addClass("require");
				alert("Please Select Sub Master Access...!");
				$("#txt1").focus();
			flag=1;
			//return false;
			}
		}
	 	else
		{
			flag=0;
		}
	if(flag=='1')
	{
		
	}
    else
    {
      document.getElementById('btnsub').disabled=true;
	  var url = "ins_user_creation.php"; 
      //alert(url);
      // the script where you handle the form input.
      $.ajax({
           type: "POST",
           url: url,
           data: $("#companyMaster").serialize(), // serializes the form's elements.
           success: function(data)
           {
				alert(data);
				//document.getElementById('abc').innerHTML=data;
				document.getElementById('btnsub').disabled=false;
				window.location.href='user_creation.php';
           }
         });     
      e.preventDefault(); 
    }
     // avoid to execute the actual submit of the form.
  });
	
function getLoc()	
{
  if(document.getElementById('compId').value=='0')
  {
	if(document.getElementById('urole').value=='admin')
    {
	  
    }
	else
	{
	  alert('Plz, Select Company Name..!'); 	
	  document.getElementById('compId').focus();	
	}
  }
  else	
  {
	  var id = document.getElementById('compId').value;
	  var uId= document.getElementById('uid').value;
	  var uloc= document.getElementById('uloc').value;
	  var iType= document.getElementById('iType').value;
	  var uiType= document.getElementById('uiType').value;
	  var scriptUrl ='getLocations_usr.php?compId='+id+'&iType='+iType+'&uiType='+uiType+'&uId='+uId+'&uloc='+uloc;
	  //alert(scriptUrl);
      $.ajax({url:scriptUrl,success:function(result)
      {	
	  	 //alert(result);
         //document.getElementById('location').innerHTML=result;
		  $("#location").html(result).trigger("chosen:updated.chosen");
      }}); 
  }
}
	
function addMultiLocation(tableId)
{
	//alert("hi");
	var k=0;
	var table=document.getElementById(tableId);
	var rowCount = table.rows.length;
	var str=rowCount;
	var row=table.insertRow(table.rows.length);	
	var e = document.getElementById("location");
	var catalogText = e.options[e.selectedIndex].text;
	var val=e.value.split('||');
	var vvv=catalogText;
	//alert(val);
	
	var plcId= document.getElementsByName("locId[]");

    var flag=0;
    for(var i=0;i<plcId.length;i++)
    {
        if(val==plcId[i].value)
        {
            flag++;
        }
    }

	if(flag==0)
	{
		var cell1 = row.insertCell(0); //chekbox  
		var element1 = document.createElement("input");
		element1.type = "hidden";
		element1.id = "locId"+str;
		element1.name = "locId[]";
		element1.className="textbox";
		element1.value=val[0];
		cell1.appendChild(element1); 
		
		var element11 = document.createElement("input");		
		element11.type = "hidden";
		element11.id = "locType"+str;
		element11.name = "locType[]";
		element11.className="textbox";
		element11.value=val[1];
		cell1.appendChild(element11);
		
		var element12 = document.createElement("label");
		element12.id = "loclbl"+str;
		element12.innerHTML=vvv;
		cell1.appendChild(element12);
		var cell2 = row.insertCell(1); //chekbox  	

		var oImg=document.createElement("img");
		oImg.setAttribute('src', 'img/delete.png');
		oImg.setAttribute('alt', 'Remove');
		oImg.onclick=function()
		{
			del(str);
		}
		cell2.appendChild(oImg);
		k=str+1;
		document.getElementById('locRec').value=k;
	}
}

function del(ro)
{
  var i, n, cb, en, ed, len, tbl;
  tbl = document.getElementById('contact_tbl');
  var count = tbl.rows.length;
  len = tbl.rows.length;
  n = 0; // assumes ID numbers start at zero
  for (i = 0; i < len; i++) {
    cb = document.getElementById("locId" + i);
	en = document.getElementById("loclbl" + i);

      if (ro==i)
	  { 
		  tbl.deleteRow(n);
		  count--;
	  }
	  else
	  {
		  cb.id = "locId" + n;
		  en.id = "loclbl" + n;
		  ++n;
	  }
  }
}	
</script>
</body>

</html>