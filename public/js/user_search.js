$(function () {
  // 検索条件の開閉
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();

    // 矢印の変更（△ ↔ ▽）
    const arrow = $('.arrow-icon');
    arrow.text(arrow.text() === '▽' ? '△' : '▽');
  });

  // 選択科目の登録 開閉＆矢印切り替え
  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();

    // 矢印の切り替え（このボタン内の .arrow 要素だけ）
    let arrow = $(this).find('.arrow');
    arrow.text(arrow.text() === '△' ? '▽' : '△');
  });
});
