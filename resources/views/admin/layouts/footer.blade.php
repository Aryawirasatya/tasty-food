                </div> <!-- /.container-fluid -->
            </div> <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div> <!-- End of Content Wrapper -->
    </div> <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- JS Bundle --}}
    <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script> 
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>
     <script src="{{ asset('assets/admin/js/demo/chart-pie-demo.js') }}"></script>
     
<script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Delegasi klik: aman untuk DOM yang berubah-ubah
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.js-delete-btn');
    if (!btn) return;

    const form = btn.closest('form');
    const title = btn.dataset.title || 'data ini';

    // Kalau SweetAlert gagal load, jangan hapus diam-diam
    if (typeof Swal === 'undefined') {
      alert('Gagal memuat konfirmasi. Coba reload halaman.');
      return;
    }

    Swal.fire({
      title: 'Hapus data?',
      text: `Anda yakin ingin menghapus "${title}"? Tindakan ini tidak bisa dibatalkan.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      focusCancel: true
    }).then((r) => {
      if (r.isConfirmed) form.submit();
    });
  });
</script>
{{-- <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}" defer></script> --}}
<script src="{{ asset('js/delete-confirm.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
