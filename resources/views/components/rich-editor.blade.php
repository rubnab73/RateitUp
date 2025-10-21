@props(['name', 'value' => '', 'label' => null])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<div 
    x-data 
    x-init="
        // Destroy previous editor instance if exists
        if (tinymce.get('{{ $name }}')) {
            tinymce.get('{{ $name }}').remove();
        }

        tinymce.init({
            selector: '#' + '{{ $name }}',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            image_advtab: true,
            height: 400,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.setContent(@js($value));
                });
                // Optional: update hidden textarea on change
                editor.on('change keyup', () => {
                    editor.save(); // Syncs content back to <textarea>
                });
            }
        });
    "
    wire:ignore
>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
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
