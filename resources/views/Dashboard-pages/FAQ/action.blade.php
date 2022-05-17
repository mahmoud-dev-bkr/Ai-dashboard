@if ($type == "action")
    <a href=""><i class="fa fa-pen"></i></a>
    <a href=""><i class="fa fa-trash"></i></a>
@endif

@if ($type == "view")
<label for="my-modal-5" class="btn modal-button"><i class="fa fa-eye"></i></label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-5" class="modal-toggle" />
<div class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
    <h3 class="font-bold text-lg"></h3>
    <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
    <div class="modal-action">
      <label for="my-modal-5" class="btn">Close</label>
    </div>
  </div>
</div>
@endif