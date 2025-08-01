$(function () {
  $(function () {
    $('.open-cancel-modal').on('click', function () {
      const date = $(this).data('date');
      const label = $(this).data('label');

      $('#modalDate').text(date);
      $('#modalLabel').text(label);
      $('#deleteDateInput').val(date);

      const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
      modal.show();
    });
  });
});
