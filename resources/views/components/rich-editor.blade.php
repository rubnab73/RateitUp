@props(['name', 'value' => '', 'label' => null])

@if($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<div 
    x-data="{ 
        init() {
            tinymce.init({
                selector: '#' + '{{ $name }}',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                image_advtab: true,
                link_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_class_list: [
                    { title: 'None', value: '' },
                    { title: 'Some class', value: 'class-name' }
                ],
                importcss_append: true,
                height: 400,
                file_picker_callback: (callback, value, meta) => {
                    // Code for file picker will be added
                },
                templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                setup: (editor) => {
                    editor.on('init', () => {
                        editor.setContent('{{ $value }}');
                    });
                }
            });
        }
    }"
    wire:ignore
>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        {{ $attributes }}
    >{{ $value }}</textarea>
</div>

@push('styles')
<style>
    .tox-tinymce {
        border-radius: 0.375rem !important;
        border-color: rgb(209 213 219) !important;
    }
    .tox .tox-toolbar__group {
        padding: 0 8px !important;
    }
    .tox .tox-toolbar__primary {
        background: none !important;
        border-bottom: 1px solid rgb(229 231 235) !important;
    }
    .tox .tox-edit-area__iframe {
        background-color: #ffffff !important;
    }
    .tox .tox-statusbar {
        border-top: 1px solid rgb(229 231 235) !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('vendor/tinymce/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endpush