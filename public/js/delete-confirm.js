(function () {
  document.addEventListener('submit', function (e) {
    const form = e.target.closest('.js-confirm-delete');
    if (!form) return;

    e.preventDefault();

    const title = form.dataset.title || 'Hapus data?';
    const html  = form.dataset.text  || 'Tindakan ini tidak bisa dibatalkan.';

    // fallback kalau SweetAlert gagal dimuat (CSP/CDN)
    if (typeof Swal === 'undefined') {
      const plain = (title + '\n\n' + html.replace(/<[^>]+>/g,'')).trim();
      if (confirm(plain)) form.submit();
      return;
    }

    Swal.fire({
      title, html, icon:'warning',
      showCancelButton:true,
      confirmButtonText:'Ya, hapus',
      cancelButtonText:'Batal',
      reverseButtons:true,
      focusCancel:true
    }).then(r => { if (r.isConfirmed) form.submit(); });
  });
})();
