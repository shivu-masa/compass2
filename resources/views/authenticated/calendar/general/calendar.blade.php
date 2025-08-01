<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
<form method="POST" action="{{ route('reserveParts') }}" id="reserveParts">
    @csrf
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </form>
    </div>
  </div>
</div>

<!-- モーダル -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
        <p>予約日: <span id="modalDate"></span></p>
        <p>予約時間: <span id="modalLabel"></span></p>
         <p>上記の予約をキャンセルしてもよろしいですか？</p>
      </div>

      <div class="modal-footer">
        <form method="POST" action="{{ route('deleteParts') }}">
          @csrf
          <input type="hidden" name="delete_date" id="deleteDateInput">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          <button type="submit" class="btn btn-danger">キャンセル</button>

        </form>
      </div>
    </div>
  </div>
</div>

</x-sidebar>
