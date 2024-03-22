{{-- Print a success message for any successful action --}}
@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Ready!', "{{ session('success') }}", 'success');
        })
    </script>

{{-- Print an error message for any unsuccessful action --}}
@elseif ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Error!', "{!! $message !!}", 'error');
        })
    </script>
@endif
