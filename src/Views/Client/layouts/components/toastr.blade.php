@isset($_SESSION['message'])
<script>
    toastr.options = {
            "progressBar": true,
            "timeOut": 5000,
            "closeButton": true
        };
        toastr["{{ $_SESSION['type'] ?? 'success' }}"]("{{ $_SESSION['message'] ?? '' }}");
</script>
@endisset