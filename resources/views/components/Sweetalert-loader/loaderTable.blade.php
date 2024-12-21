<script>
    $(document).ready(function() {
        // Menampilkan loading saat halaman dimuat
        $('#loading').show();
        $('#data-table').hide();
        $('#no-data').hide();

        // Simulasikan pengambilan data (misal menggunakan AJAX)
        setTimeout(function() {
            // Setelah data dimuat, sembunyikan loading dan tampilkan tabel
            $('#loading').hide();
            @if ($aspek->isNotEmpty())
                $('#data-table').show();
            @else
                $('#no-data').show();
            @endif
        }, 2000); // Simulasi delay pengambilan data selama 2 detik
    });
</script>
