<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Zoeken naar een nieuwsbericht</h4>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('admin.news.index') }}" id="searchForm">
                    <input type="text" class="form-control" @input('term') placeholder="Nieuwsbericht zoeken op basis van titel">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-fw fa-undo"></i> Annuleren
                </button>
                <button type="submit" form="searchForm" class="btn btn-primary">
                    <i class="fa fa-fw fa-search"></i> Zoeken
                </button>
            </div>
        </div> {{-- /.modal-content --}}
    </div> {{-- /.modal-dialog --}}
</div> {{-- /.modal --}}