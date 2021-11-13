@extends('layouts.app')
@section('title')
    Config
@endsection
@section('content')
<h1 class="h3 mb-2 text-gray-800" id="localeTitle"><span data-localize="locales"></span> - <?php
    if (isset($_GET['file'])) {
        $fileLocale = $_GET['file'] . '.json';
    } else {
        $fileLocale = asset('locales/en_US.json');
    }
    $fileLocale = substr($fileLocale, 0, -5);
    echo $fileLocale;
    ?></h1>
<div id="error" style="display:none;" class="alert alert-danger"></div>

@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
<div class="row">
    <div class="col-sm-6">
        <div class="p-1">
            <h6 data-localize="locales_info">From this section you make changes to the localizations or add a new ones.
            </h6>
            <br/>
            <form class="user" method="post" id="localeForm" action="{{ route('locale.update') }}">
                @csrf
                <div id="localeStrings"></div>

                {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary btn-block','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <hr>
            </form>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="p-1">
            <h6 data-localize="locales_desc">
                Choose a locale from the list below. The default one is en_US and is loaded first. If you need to add another localization file choose a name and click on the Add button. It will copy the default en_US locale and you can edit it from the form in the left.
            </h6>
            <br/>
            <form class="user" method="post" action="{{ route('locale.store') }}">
                @csrf
                <div class="form-group">
                    <label for="roomName"><h6 data-localize="locales_name">Locale name</h6></label>
                    <input type="text" class="form-control" id="fileName" name="fileName" aria-describedby="fileName">
                </div>
                {{ Form::button('Add', ['type'=>'submit','class' => 'btn btn-primary btn-block','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <br/>
            </form>

            <?php
            if ($handle = opendir(public_path('locales'))) {
                echo '<a href="/locale" class="btn btn-light">en_US</a><hr>';
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != "en_US.json" && substr($entry, -3) != "zip") {
                        $entry = substr($entry, 0, -5);
                        $delete = '| <a href="javascript:void(0)" data-file="' . $entry .'" id="deleteLocale' . $entry . '" class="btn btn-light delete-locale">Delete</a>';
                        echo '<a href="/locale?file=' . $entry.'.json' . '" class="btn btn-light">' . $entry . '</a>' . $delete . '<hr>';
                    }
                }

                closedir($handle);
            }
            ?>
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
    <script>
        let localeIndexUrl = "{{ route('locale.index') }}";
        let localeUpdateUrl = "{{ route('locale.update') }}";
        let  fileName = "{{ $fileName }}";

        <?php
            $jsonString = file_get_contents(public_path('locales/').$fileName);
            $data = json_decode($jsonString, true);
            $fileContent = '';
            $fileData = '';
            foreach ($data as $key => $value) {
                $fileContent .= '<div class="form-group"><label for="roomName"><h6>' . $key . ':</h6></label><input type="text" class="form-control" id="' . $key . '" aria-describedby="' . $key . '" value="' . htmlentities(addslashes($value)) . '"></div>';
                $fileData .= "'" . $key . "': $('#" . $key . "').val(),";
            };
            $fileData = substr($fileData, 0, -1);
        ?>
        $(document).ready(function () {
            $('#localeStrings').html('<?php echo $fileContent; ?>');
        });

        // Update From
        $(document).on('submit', '#localeForm', function (event) {
            event.preventDefault();
            let loadingButton = $('#btnSave');
            loadingButton.button('loading');
            let dataObj = {'fileName': fileName, 'data': {<?php echo $fileData; ?>}};
            $.ajax({
                url: localeUpdateUrl,
                type: 'POST',
                dataType: 'json',
                data: dataObj,
                cache: false,
                success: function (obj) {
                    if (obj) {
                        location.href = localeIndexUrl+'?file='+fileName;
                    }
                },
                error: function (data) {
                    console.log(data);
                },
            });
        });

        $(document).on('click', '.delete-locale', function (event) {
            event.preventDefault();
            let fileName = $(this).attr('data-file');
            swal({
                    title: 'Delete !',
                    text: 'Are you sure want to delete this "' + 'Locale' + '" ?',
                    type: 'warning',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                },
                function () {
                    $.ajax({
                        type: 'POST',
                        url: localeIndexUrl + '/delete',
                        data: {fileName : fileName},
                        success: function (data) {
                            swal({
                                title: 'Deleted!',
                                text: 'Locale' + ' has been deleted.',
                                type: 'success',
                                confirmButtonColor: '#6777ef',
                                timer: 2000,
                            });
                            if (data.success) {
                                setTimeout(function (){
                                    location.reload();
                                },1000);
                            }
                        },
                        error: function (data) {
                            swal({
                                title: '',
                                text: data.responseJSON.message,
                                type: 'error',
                                confirmButtonColor: '#6777ef',
                                timer: 5000,
                            });
                        },
                    });
                });
            });
    </script>
@endsection
