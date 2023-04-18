@php ($attributes = (isset($value['attributes']) ? $value['attributes'] : []))
@php ($attributes['id'] = (isset($attributes['id']) ? $attributes['id'] : $key))
@php ($attributes['class'] = (isset($attributes['class']) ? $attributes['class'] : 'form-control'))
@php ($attributes['class'] .= ($errors->has($key) ? ' is-invalid' : ''))
@php ($floatOff = ['select', 'multiselect', 'file', 'radio', 'checkbox', 'editor', 'date', 'custom', 'switch'])
@php ($labelWidth = (isset($value['label_width']) ? $value['label_width'] : 'col-lg-3 col-md-3 col-sm-6 col-xs-12 text-right'))
@php ($fieldWidth = (isset($value['field_width']) ? $value['field_width'] : 'col-lg-6 col-md-6 col-xs-12 col-sm-12'))
@php ($value['value'] = isset($value['value']) ? $value['value'] : null)
@if($coverClass)
<div class="{{ $coverClass }}">
@endif
    @if(isset($value['label']) && $value['label'])
    <div class="{{ $labelWidth }}">
        <label for="{{ $attributes['id'] }}" class="col-form-label">{!! $value['label'] . (isset($attributes['required']) ? ' <span class="text-danger">*</span>' : '') !!}</label>
        @if(isset($value['help']))
        <p class="help-info"><small>{{ $value['help'] }}</small></p>
        @endif
    </div>
    @endif
    <div class="{{ $fieldWidth }}">
        <div class="{{ !in_array($value['type'], $floatOff) ? 'form-line' : '' }} {{ $errors->has($key) ? 'error' : '' }}">
            @if($value['type'] == 'text')
                {!! Form::text($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'label')
                @php ($attributes['readonly'] = 'true')
                @php ($attributes['disabled'] = 'true')
                {!! Form::text($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'email')
                {!! Form::email($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'number')
                {!! Form::number($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'date')
                @php($attributes['class'] .= ' datepicker')
                {!! Form::text($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'time')
                @php($attributes['class'] .= ' timepicker')
                {!! Form::text($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'datetime')
                @php($attributes['class'] .= ' datetimepicker')
                {!! Form::text($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'password')
                {!! Form::password($key, $attributes) !!}
            @elseif($value['type'] == 'textarea')
                {!! Form::textarea($key, $inputValue, $attributes) !!}
            @elseif($value['type'] == 'editor')
                @php ($attributes['class'] .= ' editor')
                {!! Form::textarea($key, $inputValue, $attributes) !!}
                @once
                    @push('page_script')
                    <script src="{{ asset('/administrator/admin-form-plugins/tinymce/tinymce.min.js')}}" ></script>
                    <script>
                        tinymce.init({
                            selector:'.editor',
                            theme: "modern",
                            height: 300,
                            plugins: [
                                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                "save table contextmenu directionality emoticons template paste textcolor"
                            ],
                            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                            style_formats: [
                                {title: 'Bold text', inline: 'b'},
                                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                                {title: 'Example 1', inline: 'span', classes: 'example1'},
                                {title: 'Example 2', inline: 'span', classes: 'example2'},
                                {title: 'Table styles'},
                                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                            ]
                        });
                    </script>
                    @endpush
                @endonce
            @elseif($value['type'] == 'select')
                @php($attributes['data-live-search'] = "true")
                @php($attributes['data-size'] = 5)
                @php($attributes['class'] .= ' live-search')
                @if(is_array($value['options']) && !empty($value['options']))
                    @php($value['options'] = ['' => 'Select Option'] + $value['options'])
                @endif
                {!! Form::select($key, $value['options'], $value['value'], $attributes) !!}
            @elseif($value['type'] == 'multiselect')
                @php ($attributes['multiple'] = 'true')
                {!! Form::select($key, $value['options'], $value['value'], $attributes) !!}
            @elseif($value['type'] == 'radio')
                <div class="clearfix"></div>
                <div class="row">
                @foreach($value['options'] as $k => $option)
                    <div class="{{ isset($value['attributes']['width']) ? $value['attributes']['width'] : 'col-lg-6 col-md-6 col-sm-12 col-xs-12' }}">
                        <div class="custom-control custom-radio custom-radio-primary mt-2">
                            <input name="{{ $key }}" type="radio"  value="{{ $k }}" id="{{ $key . '-' . $k }}" {{ $value['value'] == $k ? 'checked' : '' }} class="{{ $key }} custom-control-input" />
                            <label class="custom-control-label" for="{{ $key . '-' . $k }}">{{ $option }}</label>
                        </div>
                    </div>
                @endforeach
                </div>
            @elseif($value['type'] == 'checkbox')
                <div class="clearfix"></div>
                <div class="row">
                    @foreach($value['options'] as $k => $option)
                    <div class="{{ isset($value['attributes']['width']) ? $value['attributes']['width'] : 'col-lg-6 col-md-6 col-sm-12 col-xs-12' }}">
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" name="{{ $key }}[]" value="{{ $k }}" id="{{ $key . '-' . $k }}" {{ (is_array($value['value']) && in_array($k, $value['value'])) ? 'checked' : '' }} class="{{ $key }} custom-control-input" />
                            <label class="custom-control-label" for="{{ $key . '-' . $k }}">{{ $option }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            @elseif($value['type'] == 'switch')
                @foreach($value['options'] as $k => $option)
                <div class="{{ isset($value['attributes']['width']) ? $value['attributes']['width'] : 'col-lg-6 col-md-6 col-sm-12 col-xs-12' }}">
                    <div class="square-switch">
                        <input type="checkbox"  name="{{ $key }}" value="{{ $k }}" id="{{ $key . '-' . $k }}" {{ $value['value'] == $k ? 'checked' : '' }} switch="none"  class="{{ $key }}"/>
                        <label for="{{ $key . '-' . $k }}" data-on-label="{{ $option }}" data-off-label=""></label>
                    </div>
                </div>
                @endforeach
            @elseif($value['type'] == 'file')
                @php ($fileInputName = $key)
                @if(array_key_exists("cropper", $attributes) && $attributes['cropper'])
                    @php ($cropRatio = (isset($attributes['ratio']) && $attributes['ratio']) ? $attributes['ratio'] : '400x300')
                    @php ($attributes['onchange'] = "readImage(this, '". $cropRatio ."')")
                    @php ($fileInputName .= '_input')
                @endif
                @if(!isset($attributes['id']))
                    @php ($attributes['id'] = $key)
                @endif
                @php ($attributes['class'] .= 'custom-file-input')
                @if(isset($attributes['multiple']) && $attributes['multiple'])
                    <div class="d-flex gallery-panel" id="posted_photo_image">
                        @if(isset($value['value']))
                            @foreach($value['value'] as $f => $file)
                                @php($file = isset($file['original']) ? $file : \App\Models\File::file($file))
                                @if(in_array($file['file_mime'], \App\Models\File::$fileValidations['image']['file_mimes']))
                                    <div class="gallery-block animate" style="display: none;" id="{{ $key . $f . '_preview' }}">
                                        <img src="{{ $file['thumb'] }}">
                                        <a href="javascript:void(0);" class="gallery-close delete-attachment-form" data-id="{{ $file['id'] }}"><i class="mdi mdi-close-circle"></i></a>
                                    </div>
                                @elseif($file['file_mime'])
                                    <a href="{{ $file['original'] }}" target="_blank">View File</a>
                                @endif
                            @endforeach
                        @endif
                        <div class="gallery-block add-gellery" data-name="{{ $key }}">
                            <i class="dripicons-plus"></i>
                        </div>
                    </div>
                    @once
                        @push('page_script')
                        <script type="text/javascript">
                            var no_file = 1;
                            const processImages = async(input) => {
                                if (input.files && input.files[0]) {
                                    for (var i = 0; i < input.files.length; ++i) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            var image_div = '<div id="' + no_file + '_preview" class="gallery-block animate" style="display: none;"> <img src="' + e.target.result + '" class="img-responsive" style="height: auto; width: 100%; float: left;" /><a href="javascript:void(0);" class="gallery-close" data-id="' + no_file + '_preview"><i class="mdi mdi-close-circle"></i></a></div>';
                                            $("#posted_photo_image").prepend(image_div);
                                            no_file = no_file + 1;
                                        };
                                        reader.readAsDataURL(input.files[i]);
                                    }
                                }
                                return true;
                            }
                            function readURL(input) {
                                processImages(input).then(function() {
                                    setTimeout( function() {
                                        animateZoomIn();
                                    }, 200);
                                });
                            }

                            $("body").on("click", ".add-gellery", function() {
                                var name = $(this).data('name');
                                 no_file = no_file + 1;
                                var file = '<input name="'+ name +'[]" id="listing_photo' + no_file + '" multiple="true" onchange="readURL(this);" type="file" style="display:none;"/>';
                                $("#posted_photo_image").append(file);
                                $("#listing_photo" + no_file).click();
                            });

                            $("body").on('click', '.gallery-close', function() {
                                var file_no = $(this).data('id');
                                $("#posted_photo_image").find("#" + file_no).remove();
                            });
                        </script>
                        @endpush
                    @endonce
                @else
                    @php($value['value'] = isset($value['value']['original']) ? $value['value'] : \App\Models\File::file($value['value']))
                    @if(in_array($value['value']['file_mime'], \App\Models\File::$fileValidations['image']['file_mimes']))
                        <div class="col-lg-4 p-0">
                            <img src="{{ $value['value']['thumb'] }}" class="img-responsive img-thumbnail" id="{{ $key . '_preview' }}" />
                            <a href="javascript:void(0);" class="gallery-close delete-attachment-form" data-id="{{ $value['value']['id'] }}"><i class="mdi mdi-close-circle"></i></a>
                        </div>
                    @elseif($value['value']['file_mime'])
                        <a href="{{ $value['value']['original'] }}" target="_blank">View File</a>
                    @endif
                    <div class="custom-file mb-3">
                        {!! Form::file($fileInputName, $attributes) !!}
                        <label class="custom-file-label" for="{{ $attributes['id'] }}">Choose file</label>
                    </div>
                @endif
            @elseif($value['type'] == 'custom')
                {!! $value['value'] !!}
            @endif
        </div>
        
        @if ($errors->has($key))
            <label class="invalid-feedback text-danger error">{{ $errors->first($key) }}</label>
        @endif
    </div>
@if($coverClass)
</div>
@endif