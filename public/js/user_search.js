$(function () {
  // 検索条件の開閉
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();

    // 矢印の変更（△ ↔ ▽）
    const arrow = $('.arrow-icon');
    const current = arrow.text();
    arrow.text(current === '▽' ? '△' : '▽');
  });

  // 既存の subject_edit_btn の開閉（必要な場合）
  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});
