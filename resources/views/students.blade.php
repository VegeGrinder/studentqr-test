<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Students</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
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
                    <button class="btn btn-sm w-100 btn-outline-primary mb-2">UPLOAD</button>
                </div>
                <div class="col">
                    <button class="btn btn-sm w-100 btn-outline-danger mb-2">RESET</button>
                </div>
            </div>

            {{-- Bottom Table/Data --}}
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th class="text-center">Class</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Parent Contact</th>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">No data</td>
                </tr>
            </table>
        </div>
    </body>
</html>
