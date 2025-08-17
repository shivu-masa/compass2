$(function () {
  $('.search_conditions').click(function () {
    // hr を挟んでも正しく展開できるように nextAll() を使う
    $(this).nextAll('.search_conditions_inner').first().slideToggle(300);

    // 矢印の切り替え
    const arrow = $(this).find('.arrow-icon');
    arrow.text(arrow.text() === '▲' ? '▼' : '▲');
  });

  // 選択科目の登録
  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    let arrow = $(this).find('.arrow');
    arrow.text(arrow.text() === '▲' ? '▼' : '▲');
  });
});
