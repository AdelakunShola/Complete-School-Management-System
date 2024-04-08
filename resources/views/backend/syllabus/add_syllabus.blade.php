@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Add Syllabus</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">SYLLABUS</a></li>
<li class="breadcrumb-item active">Add Syllabus</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('store.syllabus') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Syllabus Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Title <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="title">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="class_id">
<option value="">Select Class</option>
@foreach($classes as $class)
<option value="{{ $class->id }}">{{ $class->class_name }}</option>
@endforeach
</select>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label for="designation">Select Subject <span class="login-danger">*</span></label>
<select class="form-control" id="subject" name="subjects_id">
<option value="">Select Subject</option>
</select>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Uploaded By:</label>
<input class="form-control" type="text" name="uploaded_by_id" value="{{ auth()->user()->role }} {{ auth()->user()->name }}" readonly>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Academic Session</label>
<input class="form-control" type="text" name="session" value="{{ $setting->academic_session }}" readonly>
</div>
</div>


<div class="col-12 col-sm-12">
<div class="form-group local-forms">
<label>Description</label>
<textarea class="form-control" type="text" name="description"></textarea>
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Syllabus</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose Files <input type="file" id="syllabus" name="file_name[]" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg" multiple>
</label>
</div>
<progress id="uploadProgress" value="0" max="100"></progress>
<span id="syllabusFileName"></span>
</div>
</div>


<div class="col-12">
<div class="student-submit">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>





<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
    $(document).ready(function () {
        // Function to handle file input change for CV
        $('#syllabus').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#syllabusFileName').text('File Name: ' + fileName);
        });

        
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        // Function to handle file input change for syllabus
        $('#syllabus').change(function (e) {
            var files = e.target.files;
            var filenames = '';
            for (var i = 0; i < files.length; i++) {
                filenames += files[i].name + '<br>';
            }
            $('#syllabusFileName').html('File Names:<br>' + filenames);
        });

        // Additional functions for handling other file inputs (textbooks, folders, etc.)
    });
</script>



<script type="text/javascript">
  		
  		$(document).ready(function(){
    $('select[name="class_id"]').on('change', function(){
        var class_id = $(this).val();
        if (class_id) {
            $.ajax({
                url: "{{ url('/subject/ajax') }}/"+class_id,
                type: "GET",
                dataType:"json",
                success:function(data){
                    var subjectDropdown = $('select[name="subjects_id"]');
                    subjectDropdown.html('<option value="">Select Subject</option>'); // Set default option
                    $.each(data, function(key, value){
                        subjectDropdown.append('<option value="'+ value.id + '">' + value.name + '</option>');
                    });
                },
            });
        } else {
            $('select[name="subjects_id"]').html('<option value="">Select Subject</option>'); // Set default option
        }
    });
});

  </script>



<script type="text/javascript">
    $(document).ready(function () {
        // Function to handle file input change for syllabus
        $('#syllabus').change(function (e) {
            var files = e.target.files;
            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            // AJAX call to upload files
            $.ajax({
                url: '{{ route("store.syllabus") }}', 
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#uploadProgress').val(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                    // Handle successful upload
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    // Handle upload error
                    console.error(status, error);
                }
            });
        });
    });
</script>

@endsection