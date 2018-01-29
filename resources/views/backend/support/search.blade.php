<div class="modal fade" id="searchOrganisation" tabindex="-1" role="dialog" aria-labelledby="searchOrganisationLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="searchOrganisationLabel">Zoek een ondersteunende organisatie</h4>
            </div>
    
            <div class="modal-body">
                <form action="{{ route('admin.support.search') }}" id="search" method="GET" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" @input('term') placeholder="Zoek een organisatie bij naam" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                    <i class="fa fa-undo"></i> Annuleren
                </button>
                <button type="submit" form="search" class="btn btn-sm btn-primary">
                    <i class="fa fa-search"></i> Zoek
                </button>
            </div>
        </div>
    </div>
</div>