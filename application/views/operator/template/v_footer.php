<!-- footer @s -->
<div class="nk-footer nk-footer-fluid bg-lighter">
    <div class="container-xl">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; 2020 DashLite. Template by <a href="#">Softnio</a>
            </div>
            <div class="nk-footer-links">
                <ul class="nav nav-sm">
                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="<?= base_url() ?>assets/js/bundle.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/scripts.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/charts/gd-invest.js?ver=2.0.0"></script>
<!-- <script type="text/javascript">
    $('#sampleTable').DataTable({
        'scrollX': true
    });
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        //delete btn
        $('body').on("click", ".btn-delete", function() {
            var link = $(this).attr('id');
            $('.modal-delete').modal();
            $('.btn-delete-oke').click(function() {
                location.replace(link);
            });
        });

    });
</script>
<!-- Modal Content Code -->
<div class="modal fade zoom modal-delete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Peringatan</h5>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini.</p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-sm btn-success btn-delete-oke">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="modalSelesai">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Peringatan</h5>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menyelesaikan Tahun Akademik ini.</p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-sm btn-success">Selesai</button>
                <button class="btn btn-sm btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>