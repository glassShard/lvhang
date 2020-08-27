<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content lv-modal-content">
      <div class="modal-header lv-modal-header">
        <h3 class="modal-title">Keresés (legalább 3 betű)</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fontello-cancel"></i></span>
        </button>
      </div>
      <div class="modal-body lv-modal-body">
        <div class="form-group mb-4">
          <input type="text" class="form-control lv-form search-field" id="search" name="search" placeholder="Keresett szöveg..." value="">
        </div>

        <div id="results">

        </div>
      </div>

    </div>
  </div>
</div>

<button type="button" class="search-opener btn btn-lg lv-btn" data-toggle="modal" data-target="#searchModal"><i class="fontello-search"></i></button>
