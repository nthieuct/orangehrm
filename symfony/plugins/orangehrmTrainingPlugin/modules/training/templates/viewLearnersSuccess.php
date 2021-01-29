<?php
if (isset($_POST['txtlearnerid'])) {
	if ($_POST['txtlearnerid'] == '') {
		$learner->addLearner($_POST['txtlearnername'], date('Y-m-d', strtotime($_POST['txtstartdate'])), date('Y-m-d', strtotime($_POST['txtenddate'])), $_POST['txtplace'], $_POST['txtorganization']);
	} else {
		$learner->updateLearner($_POST['txtlearnerid'], $_POST['txtlearnername'], date('Y-m-d', strtotime($_POST['txtstartdate'])), date('Y-m-d', strtotime($_POST['txtenddate'])), $_POST['txtplace'], $_POST['txtorganization']);
	}
}

if (isset($_POST['txtlearneriddel'])) {
	$learner->deleteLearner($_POST['txtlearneriddel']);
}

if (isset($_REQUEST['sortField']))
	$sortfield = $_REQUEST['sortField'];
else
	$sortfield = 'b.course_name';

if (isset($_REQUEST['sortOrder']))
	$sortorder = $_REQUEST['sortOrder'];
else
	$sortorder = 'ASC';

if (isset($_POST['cboCourseSearch']))
	$s_course = $_POST['cboCourseSearch'];
else if (isset($_REQUEST['s_course']))
	$s_course = $_REQUEST['s_course'];
else
	$s_course = '0';

if (isset($_POST['cboEmpSearch']))
	$s_emp = $_POST['cboEmpSearch'];
else if (isset($_REQUEST['s_emp']))
	$s_emp = $_REQUEST['s_emp'];
else
	$s_emp = '0';

if (isset($_POST['txtfromdate']))
	$s_fromdate = $_POST['txtfromdate'];
else if (isset($_REQUEST['s_fromdate']))
	$s_fromdate = $_REQUEST['s_fromdate'];
else
	$s_fromdate = date('01-01-Y');

if (isset($_POST['txttodate']))
	$s_todate = $_POST['txttodate'];
else if (isset($_REQUEST['s_todate']))
	$s_todate = $_REQUEST['s_todate'];
else
	$s_todate = date('31-12-Y');

if (isset($_REQUEST['id'])) {
	$rowC = $learner->getLearner($_REQUEST['id']);
	foreach($rowC as $row) {
		$learnername = $row['course_name'];
		$startdate = date('d-m-Y', strtotime($row["start_date"]));
		$enddate = date('d-m-Y', strtotime($row["end_date"]));
		$place = $row['place'];
		$organization = $row['organization'];
	}
}
?>

<link rel="stylesheet" type="text/css" media="all" href="/orangehrm/symfony/web/webres_5fa517042fb5e3.16670395/themes/default/css/orangehrm.datepicker.css" />

<div style="width: 63%; float: left;">
	<div class="box searchForm toggableForm" id="srchLearners">
	   <div class="head">
		  <h1>Thông tin đào tạo</h1>
	   </div>
	   <div class="inner">
		  <form name="frmSrchLearners" id="frmSrchLearners" method="post" action="/orangehrm/symfony/web/index.php/training/viewLearners">
			 <fieldset>
				<ol>
				   <li>
					  <label>Khóa đào tạo</label>                        
					  <select name="cboCourseSearch" id="cboCourseSearch">
					     <option value="0">Tất cả</option>
						 <?php
						 $rowCs = $course->getAllCourses('', 'c.course_name', 'asc');
						 foreach($rowCs as $row) {
						    if ($s_course == $row['course_id'])
								$sl = ' selected="selected"';
							else
								$sl = '';
							
							echo '<option value="'.$row['course_id'].'"'.$sl.'>'.$row['course_name'].'</option>';
						 }
						 ?>
					  </select>
				   </li>
				   <li>
					  <label>Nhân viên</label>                        
					  <select name="cboEmpSearch" id="cboEmpSearch">
					     <option value="0">Tất cả</option>
						 <?php
						 $rowEs = $learner->getAllEmps();
						 foreach($rowEs as $row) {
							if ($s_emp == $row['emp_number'])
								$sl = ' selected="selected"';
							else
								$sl = '';
							
						    echo '<option value="'.$row['emp_number'].'"'.$sl.'>'.$row['emp_firstname'].' '.$row['emp_middle_name'].' '.$row['emp_lastname'].'</option>';
						 }
						 ?>
					  </select>
				   </li>
				   <li>
					  <label>Từ ngày</label>  
					  <input id="txtfromdate" type="text" name="txtfromdate" class="calendar" value="<?php echo $s_fromdate; ?>" />
				   </li>
				   <li>
					  <label>Đến ngày</label>  
				      <input id="txttodate" type="text" name="txttodate" class="calendar" value="<?php echo $s_todate; ?>" />
				   </li>
				</ol>
				<p>
				   <input type="submit" id="btnSrch" value="Tìm kiếm" name="btnSrch" class="">
				   <input type="button" class="reset" id="btnRst" value="Thiết lập lại" name="btnSrch" onclick="document.frmRst.submit();">                   
				</p>
			 </fieldset>
		  </form>
	   </div>
	</div>

	<div class="box noHeader" id="search-results">
	   <div class="inner">
		 <div id="tableWrapper">
			 <table class="table hover" id="resultTable">
			    <thead>
				   <tr>
					  <th rowspan="1" style="width:5%" class="center"><i class="fas fa-trash"></i></th>
					  <th rowspan="1" style="width:5%" class="center"><i class="fas fa-edit"></i></th>
					  <th rowspan="1" style="width:20%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=b.course_name&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Tên khóa đào tạo</a></th>
					  <th rowspan="1" style="width:10%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=b.start_date&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Ngày BĐ</a></th>
					  <th rowspan="1" style="width:10%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=b.end_date&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Ngày KT</a></th>
					  <th rowspan="1" style="width:20%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=c.emp_lastname&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Tên nhân viên</a></th>
					  <th rowspan="1" style="width:15%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=a.result&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Kết quả</a></th>
					  <th rowspan="1" style="width:15%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewLearners?sortField=a.note&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?><?php echo '&amp;s_course='.$s_course.'&amp;s_emp='.$s_emp.'&amp;s_fromdate='.$s_fromdate.'&amp;s_todate='.$s_todate; ?>" class="null">Ghi chú</a></th>
				   </tr>
			    </thead>
			    <tbody>
				    <?php
				    $rowLs = $learner->getAllLearners($s_course, $s_emp, date('Y-m-d', strtotime($s_fromdate)), date('Y-m-d', strtotime($s_todate)), $sortfield, $sortorder);
				    
					$stt = 1;
					foreach($rowLs as $row) {
						if ($stt % 2 == 0)
							$tr_class = "even";
						else
							$tr_class = "odd";
						
						echo '<tr class="'.$tr_class.'">
							<td class="center"><a class="del" href="#" id="'.$row['course_id'].'"><i class="fas fa-trash"></i></a></td>
							<td class="center"><a href="/orangehrm/symfony/web/index.php/training/viewLearners?id='.$row['course_id'].'"><i class="fas fa-edit"></i></a></td>
							<td class="left">'.$row['course_name'].'</td>
							<td class="left">'.date('d-m-Y', strtotime($row["start_date"])).'</td>
							<td class="left">'.date('d-m-Y', strtotime($row["end_date"])).'</td>
							<td class="left">'.$row['emp_firstname'].' '.$row['emp_middle_name'].' '.$row['emp_lastname'].'</td>
							<td class="left">'.$row['result'].'</td>
							<td class="left">'.$row['note'].'</td>
							</tr>';
										
						$stt++;
					}
					
					if ($stt == 1)
						echo '<tr><td colspan="8">Không có khóa đào tạo nào</td></tr>';
				    ?>
			    </tbody>
			 </table>
		  </div>
		  <!-- tableWrapper -->
	   </div>
	   <!-- inner -->
	</div>
</div>

<div class="box addForm toggableForm" id="addLearner" style="width: 35%; float: left; margin-left: 0;">
   <div class="head">
      <h1>Chi tiết đào tạo</h1>
   </div>
   <div class="inner">
      <form name="frmAddLearner" id="frmAddLearner" method="post" action="/orangehrm/symfony/web/index.php/training/viewLearners">
         <fieldset>
            <input id="txtlearnerid" type="hidden" name="txtlearnerid" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; ?>" />
			<ol>
               <li>
                  <label>Tên khóa đào tạo</label>  
				  <input id="txtlearnername" type="text" name="txtlearnername" value="<?php if(isset($_REQUEST['id'])) echo $learnername; ?>" />
               </li>
               <li>
                  <label>Địa điểm đào tạo</label>  
				  <input id="txtplace" type="text" name="txtplace" value="<?php if(isset($_REQUEST['id'])) echo $place; ?>" />
               </li>
			   <li>
                  <label>Đơn vị đào tạo</label>  
				  <input id="txtorganization" type="text" name="txtorganization" value="<?php if(isset($_REQUEST['id'])) echo $organization; ?>" />
               </li>
            </ol>
            <p>
               <input type="submit" id="btnAdd" value="<?php if(isset($_REQUEST['id'])) echo 'Cập nhật'; else echo 'Thêm mới'; ?>" name="btnAdd" class="" />
               <input type="button" class="reset" id="btnRst" value="Thiết lập lại" name="btnRst" onclick="document.frmRst.submit();" />
            </p>
         </fieldset>
      </form>
	  <form name="frmRst" id="frmRst" method="post" action="/orangehrm/symfony/web/index.php/training/viewLearners"></form>
	  <form name="frmDel" id="frmDel" method="post" action="/orangehrm/symfony/web/index.php/training/viewLearners">
	     <input id="txtlearneriddel" type="hidden" name="txtlearneriddel" value="0" />
	  </form>
   </div>
</div>

<!-- Confirmation box HTML: Begins -->
<div class="modal hide" id="deleteConfModal">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>OrangeHRM - Yêu cầu xác nhận</h3>
  </div>
  <div class="modal-body">
    <p>Xóa dữ liệu?</p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn" data-dismiss="modal" id="dialogDeleteBtn" value="Đồng ý" />
    <input type="button" class="btn cancel" data-dismiss="modal" value="Hủy bỏ" />
  </div>
</div>
<!-- Confirmation box HTML: Ends -->

<script type="text/javascript" src="/orangehrm/symfony/web/webres_5fa517042fb5e3.16670395/js/orangehrm.datepicker.js"></script>

<script type="text/javascript">
	$('.del').click(function() {
		$('#txtlearneriddel').val($(this).attr('id'));
		$('#deleteConfModal').modal('show');
		return false;
	});

	/* Delete confirmation controls: Begin */
	$('#dialogDeleteBtn').click(function() {
		document.frmDel.submit();
	});
	/* Delete confirmation controls: End */


	var datepickerDateFormat = 'dd-mm-yy';
    var displayDateFormat = datepickerDateFormat.replace('yy', 'yyyy');

    $(document).ready(function(){
        
        var dateFieldValue = $.trim($("#txtfromdate").val());
        if (dateFieldValue == '') {
            $("#txtfromdate").val(displayDateFormat);
        }

        daymarker.bindElement("#txtfromdate",
        {
            showOn: "both",
            dateFormat: datepickerDateFormat,
            buttonImage: "/orangehrm/symfony/web/webres_5fa517042fb5e3.16670395/themes/default/images/calendar.png",
            buttonText:"",
            buttonImageOnly: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+100",
            firstDay: 1,
            onClose: function() {
                $("#txtfromdate").trigger('blur');
            }            
        });
        
        $("#txtfromdate").click(function(){
            daymarker.show("#txtfromdate");
            if ($(this).val() == displayDateFormat) {
                $(this).val('');
            }
        });
		
		var dateFieldValue = $.trim($("#txttodate").val());
        if (dateFieldValue == '') {
            $("#txttodate").val(displayDateFormat);
        }

        daymarker.bindElement("#txttodate",
        {
            showOn: "both",
            dateFormat: datepickerDateFormat,
            buttonImage: "/orangehrm/symfony/web/webres_5fa517042fb5e3.16670395/themes/default/images/calendar.png",
            buttonText:"",
            buttonImageOnly: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+100",
            firstDay: 1,
            onClose: function() {
                $("#txttodate").trigger('blur');
            }            
        });
        
        $("#txttodate").click(function(){
            daymarker.show("#txttodate");
            if ($(this).val() == displayDateFormat) {
                $(this).val('');
            }
        });
    
    });

</script>
