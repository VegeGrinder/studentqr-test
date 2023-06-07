<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Students</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
        <div class="custom-container">
            {{-- Top Form --}}
            <h4>Upload from file</h4>
            <div class="mb-2">
                <a target="_blank" href="{{ route('students.template') }}">Download Excel Template</a>
            </div>
            <input class="form-control mb-3" type="file" id="formFile">
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm w-100 btn-outline-primary mb-2" id="uploadButton">UPLOAD</button>
                </div>
                <div class="col">
                    <button class="btn btn-sm w-100 btn-outline-danger mb-2" id="resetButton">RESET</button>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="uniqueCheckbox">
                <label class="form-check-label" for="uniqueCheckbox">
                    Use Name & Parent Contact to check for uniqueness only (assuming all children use the same parent contact respectively and they have different names)
                </label>
            </div>

            {{-- Bottom Table/Data --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Class</th>
                            <th>Level</th>
                            <th>Parent Contact</th>
                        </tr>
                    </thead>
                    <tbody id="uploadContent">
                        @include('students-data', ['rows' => []])
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script>
    var existingStudents = null;

    $(document).ready(function() {
        $("#uploadButton").click(function() {
            var formData = new FormData();
            formData.append('new_students_file', $('#formFile')[0].files[0]);
            formData.append('existing_students', existingStudents);
            formData.append('is_special_unique', $('#uniqueCheckbox').is(':checked'));
            formData.append('_token', '{{ csrf_token() }}');

            toggleButtons(true);

            $.ajax({
                url: '{{ route('students.upload') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#uploadContent').html(data.html);
                    existingStudents = data.data;
                    alert(data.message);
                },
                error: function(jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                },
                complete: function() {
                    toggleButtons(false);
                }
            });
        });
    });

    function toggleButtons(disabled = true) {
        $('#uploadButton').prop('disabled', disabled);
        $('#resetButton').prop('disabled', disabled);
    }
</script>
