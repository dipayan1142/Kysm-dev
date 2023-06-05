$(document).ready(function(){
	$('#row-name').hide();
	$('#row-father_name').hide();
	$('#row-module_id').hide();
	$('#row-course_id').hide();

	$(document).on("click", "#get_search", function()
	{
		var registration_number = $('#registration_number').val();
		var url=PATH+'/registration/get-data';
		console.log(url)
		$.ajax({ 
			url: url,
			data: {"registration_number": registration_number},
			type: 'GET',
			success: function(result)
			{
				$('#row-name').show();
				$('#row-father_name').show();
				$('#row-module_id').show();
				$('#row-course_id').show();
				$('#name').val(result.name);
				$('#father_name').val(result.f_name);
				$('#module_id').val(result.c_code);
				// $('#course_id').val(result.course_id);
				selectCourse(result.c_code,result.course_id)
			}
		}); 
 
	});

	$("body").on("change", "#module_id", function()
	{
		var module_id = $('#module_id').val();
		selectCourse(module_id,'');
 
	});

	function selectCourse(c_code,course_id)
	{
		var url=PATH+'/registration/get-course';
		$.ajax({ 
			url: url,
			data: {"c_code": c_code},
			type: 'GET',
			success: function(result)
			{
				$('#course_id')
				.find('option')
				.remove()
				.end()
				.append(result)
				.val(course_id);
			}
		});
	}

	$('#course_name').on('change',function()
	{
		var url=PATH+'/registration/get-course';
		var course_name = $('#course_name').val();
		$.ajax({ 
			url: url,
			data: {"c_code": course_name},
			type: 'GET',
			success: function(result)
			{
				$('#c_code')
				.find('option')
				.remove()
				.end()
				.append(result)
				.val('');
			}
		});
	});

	
});