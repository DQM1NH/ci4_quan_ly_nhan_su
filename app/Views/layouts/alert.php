<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(session()->getFlashdata('success')) : ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công',
        text: '<?= session()->getFlashdata('success') ?>',
        timer: 2000,
        showConfirmButton: false
    });
</script>
<?php endif; ?>
<?php if(session()->getFlashdata('error')) : ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lỗi',
        text: '<?= session()->getFlashdata('error') ?>'
    });
</script>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {

        button.addEventListener('click', function(e) {

            e.preventDefault();

            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Bạn chắc chưa?',
                text: "Dữ liệu sẽ bị xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location.href = url;
                }

            });

        });

    });

    document.querySelectorAll('.btn-update').forEach(button => {

        button.addEventListener('click', function(e){

            e.preventDefault();

            let form = this.closest('form');
            let url = this.href;

            Swal.fire({
                title: 'Lưu thay đổi?',
                text: 'Dữ liệu sẽ được cập nhật.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Cập nhật',
                cancelButtonText: 'Hủy'
            }).then((result) => {

                if(result.isConfirmed){

                    // nếu là button submit trong form
                    if(form){
                        form.submit();
                    }

                    // nếu là link
                    else if(url){
                        window.location.href = url;
                    }

                }

            });

        });

    });
</script>
<?php endif; ?>