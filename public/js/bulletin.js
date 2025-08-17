$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });

  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_like_btn');
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/like/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });

  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });

  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

  $(document).on('click', '.delete-modal-open', function (e) {
    e.preventDefault();
    var post_id = $(this).data('post-id');

    // 正しいルートパスに修正
    $('#delete-form').attr('action', '/bulletin_board/delete/' + post_id);

    $('.js-delete-modal').fadeIn();
  });

  // 削除モーダルを閉じる
  $(document).on('click', '.js-delete-modal-close', function () {
    $('.js-delete-modal').fadeOut();
    return false;
  });

  $('.sub-category-list').hide();

  $('.category-toggle').on('click', function () {
    const targetId = $(this).data('target');       // 開閉対象のULのID取得
    const subList = $('#' + targetId);             // jQueryで取得

    subList.slideToggle(300);                      // 0.3秒で滑らかに開閉

    // この li 内の .arrow だけ切り替え
    const arrow = $(this).find('.arrow');
    arrow.text(arrow.text() === '▲' ? '▼' : '▲');
  });
});
