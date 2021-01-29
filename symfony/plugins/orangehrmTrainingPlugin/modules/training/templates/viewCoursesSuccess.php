<!-- Confirmation box HTML: Begins -->
<div class="modal hide" id="alertModal">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>OrangeHRM - Thông báo</h3>
  </div>
  <div class="modal-body" id="modal-body"></div>
</div>
<!-- Confirmation box HTML: Ends -->

<?php
if (isset($_POST['txtcourseid'])) {
	if ($_POST['txtcourseid'] == '') {
		$slt = $course->addCourse($_POST['txtcoursename'], date('Y-m-d', strtotime($_POST['txtstartdate'])), date('Y-m-d', strtotime($_POST['txtenddate'])), $_POST['txtplace'], $_POST['txtorganization']);
		echo $slt;
		if ($slt == 0) {
		?>
			<script type="text/javascript">
				//$('#modal-body').html('<p>Không thể thêm mới</p>');
				//$('#alertModal').modal('show');
			</script>
		<?php
		}
	} else {
		if ($course->updateCourse($_POST['txtcourseid'], $_POST['txtcoursename'], date('Y-m-d', strtotime($_POST['txtstartdate'])), date('Y-m-d', strtotime($_POST['txtenddate'])), $_POST['txtplace'], $_POST['txtorganization']) == 0) {
		?>
			<script type="text/javascript">
				//$('#modal-body').html('<p>Không thể cập nhật</p>');
				//$('#alertModal').modal('show');
			</script>
		<?php
		}
	}
}

if (isset($_POST['txtcourseiddel'])) {
	if ($course->deleteCourse($_POST['txtcourseiddel']) == 0) {
	?>
		<script type="text/javascript">
			//$('#modal-body').html('<p>Không thể xóa</p>');
			//$('#alertModal').modal('show');
		</script>
	<?php
	}
}

if (isset($_REQUEST['sortField']))
	$sortfield = $_REQUEST['sortField'];
else
	$sortfield = 'c.course_name';

if (isset($_REQUEST['sortOrder']))
	$sortorder = $_REQUEST['sortOrder'];
else
	$sortorder = 'ASC';

if (isset($_POST['txtkeyword']))
	$keyword = $_POST['txtkeyword'];
else
	$keyword = '';

if (isset($_REQUEST['id'])) {
	$rowC = $course->getCourse($_REQUEST['id']);
	foreach($rowC as $row) {
		$coursename = $row['course_name'];
		$startdate = date('d-m-Y', strtotime($row["start_date"]));
		$enddate = date('d-m-Y', strtotime($row["end_date"]));
		$place = $row['place'];
		$organization = $row['organization'];
	}
}
?>

<link rel="stylesheet" type="text/css" media="all" href="/orangehrm/symfony/web/webres_5fa517042fb5e3.16670395/themes/default/css/orangehrm.datepicker.css" />

<div style="width: 63%; float: left;">
	<div class="box searchForm toggableForm" id="srchCourses">
	   <div class="head">
		  <h1>Danh mục khóa đào tạo</h1>
	   </div>
	   <div class="inner">
		  <form name="frmSrchCourses" id="frmSrchCourses" method="post" action="/orangehrm/symfony/web/index.php/training/viewCourses">
			 <fieldset>
				<ol>
				   <li>
					  <label>Từ khóa tìm kiếm</label>                        
					  <input type="text" name="txtkeyword" value="" id="txtkeyword" autocomplete="off" />
				   </li>
				</ol>
				<p>
				   <input type="submit" id="btnSrch" value="Tìm kiếm" name="btnSrch" class="">
				   <input type="reset" class="reset" id="btnRst" value="Thiết lập lại" name="btnSrch">                   
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
					  <th rowspan="1" style="width:20%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewCourses?sortField=c.course_name&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?>" class="null">Tên khóa đào tạo</a></th>
					  <th rowspan="1" style="width:15%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewCourses?sortField=c.start_date&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?>" class="null">Ngày BĐ</a></th>
					  <th rowspan="1" style="width:15%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewCourses?sortField=c.end_date&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?>" class="null">Ngày KT</a></th>
					  <th rowspan="1" style="width:20%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewCourses?sortField=c.place&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?>" class="null">Địa điểm đào tạo</a></th>
					  <th rowspan="1" style="width:20%" class="header"><a href="http://localhost/orangehrm/symfony/web/index.php/training/viewCourses?sortField=c.organization&amp;sortOrder=<?php if ($sortorder == 'ASC') echo 'DESC'; else echo 'ASC'; ?>" class="null">Đơn vị đào tạo</a></th>
				   </tr>
			    </thead>
			    <tbody>
				    <?php
				    $rowCs = $course->getAllCourses($keyword, $sortfield, $sortorder);
				    
					$stt = 1;
					foreach($rowCs as $row) {
						if ($stt % 2 == 0)
							$tr_class = "even";
						else
							$tr_class = "odd";
						
						echo '<tr class="'.$tr_class.'">
							<td class="center"><a class="del" href="#" id="'.$row['course_id'].'"><i class="fas fa-trash"></i></a></td>
							<td class="center"><a href="/orangehrm/symfony/web/index.php/training/viewCourses?id='.$row['course_id'].'"><i class="fas fa-edit"></i></a></td>
							<td class="left">'.$row['course_name'].'</td>
							<td class="left">'.date('d-m-Y', strtotime($row["start_date"])).'</td>
							<td class="left">'.date('d-m-Y', strtotime($row["end_date"])).'</td>
							<td class="left">'.$row['place'].'</td>
							<td class="left">'.$row['organization'].'</td>
							</tr>';
										
						$stt++;
					}
					
					if ($stt == 1)
						echo '<tr><td colspan="7">Không có khóa đào tạo nào</td></tr>';
				    ?>
			    </tbody>
			 </table>
		  </div>
		  <!-- tableWrapper -->
	   </div>
	   <!-- inner -->
	</div>
</div>

<div class="box addForm toggableForm" id="addCourse" style="width: 35%; float: left; margin-left: 0;">
   <div class="head">
      <h1>Thông tin khóa đào tạo</h1>
   </div>
   <div class="inner">
      <form name="frmAddCourse" id="frmAddCourse" method="post" action="/orangehrm/symfony/web/index.php/training/viewCourses">
         <fieldset>
            <input id="txtcourseid" type="hidden" name="txtcourseid" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; ?>" />
			<ol>
               <li>
                  <label>Tên khóa đào tạo</label>  
				  <input id="txtcoursename" type="text" name="txtcoursename" value="<?php if(isset($_REQUEST['id'])) echo $coursename; ?>" />
               </li>
               <li>
                  <label>Ngày bắt đầu</label>  
				  <input id="txtstartdate" type="text" name="txtstartdate" class="calendar" value="<?php if(isset($_REQUEST['id'])) echo $startdate; else echo date('d-m-Y'); ?>" />
               </li>
               <li>
                  <label>Ngày kết thúc</label>  
				  <input id="txtenddate" type="text" name="txtenddate" class="calendar" value="<?php if(isset($_REQUEST['id'])) echo $enddate; else echo date('d-m-Y'); ?>" />
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
	  <form name="frmRst" id="frmRst" method="post" action="/orangehrm/symfony/web/index.php/training/viewCourses"></form>
	  <form name="frmDel" id="frmDel" method="post" action="/orangehrm/symfony/web/index.php/training/viewCourses">
	     <input id="txtcourseiddel" type="hidden" name="txtcourseiddel" value="0" />
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
		$('#txtcourseiddel').val($(this).attr('id'));
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
        
        var dateFieldValue = $.trim($("#txtstartdate").val());
        if (dateFieldValue == '') {
            $("#txtstartdate").val(displayDateFormat);
        }

        daymarker.bindElement("#txtstartdate",
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
                $("#txtstartdate").trigger('blur');
            }            
        });
        
        $("#txtstartdate").click(function(){
            daymarker.show("#txtstartdate");
            if ($(this).val() == displayDateFormat) {
                $(this).val('');
            }
        });
		
		var dateFieldValue = $.trim($("#txtenddate").val());
        if (dateFieldValue == '') {
            $("#txtenddate").val(displayDateFormat);
        }

        daymarker.bindElement("#txtenddate",
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
                $("#txtenddate").trigger('blur');
            }            
        });
        
        $("#txtenddate").click(function(){
            daymarker.show("#txtenddate");
            if ($(this).val() == displayDateFormat) {
                $(this).val('');
            }
        });
    
    });

</script>
